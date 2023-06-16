<?php
/**
 * Clinical instructions form report.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(dirname(__FILE__) . '/../../globals.php');
require_once($GLOBALS["srcdir"] . "/api.inc");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");



        $print = ' <table style="width:100%; color: #fff; background-color: #0a508c; ">
        <tr>
          <td style="width:100%; text-align:center; font-size:36px;padding-top:250px;">
            SAMHSA
          </td>
        </tr>
        <tr>
          <td style="width:100%; text-align:center; font-size:36px;">
            <b>Opioid Overdose Prevention</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; text-align:center; font-size:36px;">
            <b>TOOLKIT:</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; text-align:center; font-size:18px;">
            Facts for Community Members
          </td>
        </tr>
        <tr>
          <td style="width:100%; text-align:center; font-size:18px;">
            Five Essential Steps for First Responders
          </td>
        </tr>
        <tr>
          <td style="width:100%; text-align:center; font-size:18px;">
            Information for Prescribers
          </td>
        <tr>
        <tr>
          <td style="width:100%; text-align:center; font-size:18px;">
            Safety Advice for Patients & Family Members
          </td>
        </tr>
        <tr>
          <td style="width:100%; text-align:center; font-size:18px;">
            Recovering From Opioid Overdose
          </td>
        </tr>
        <tr>
          <td style="width:100%; text-align:center; font-size:18px;padding-bottom:250px;">
            <img src="opioid.jpg" alt="">
          </td>
        </tr>
      </table>


      <br>


      <table style="width:100%; color: #fff; background-color: #0a508c; ">
        <tr>
          <td style="padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size: 30px;">
            ACKNOWLEDGMENTS
          </td>
        </tr>
      </table>
      <table style="width:100%;">
        <tr>
          <td style="width:100%; color: #0a508c; padding-left: 40px; padding-top: 10px; font-size:22px;">
            <b>Acknowledgments</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; color: #000; padding-left: 40px; padding-right: 40px;">
          This publication was prepared for the Substance Abuse and Mental Health Services Administration (SAMHSA) by the Association of State and Territorial Health Officials, in cooperation with Public Health Research Solutions, under contract number 10-233-00100 with SAMHSA, U.S. Department of Health and Human Services (HHS). LCDR Brandon Johnson, M.B.A., served as the Government Project Officer.
          </td>
        </tr>

        <tr>
          <td style="width:100%; color: #0a508c; font-size:22px; padding-left: 40px; padding-top: 10px;">
            <b>Disclaimer</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; color: #000; padding-left: 40px; padding-right: 40px;">
          The views, opinions, and content expressed herein are those of the authors and do not necessarily reflect the official position of SAMHSA or HHS. Nothing in this document constitutes an indirect or direct endorsement by SAMHSA or HHS of any non-federal entity’s products, services, or policies, and any reference to a non-federal entity’s products, services, or policies should not be construed as such. No official support of or endorsement by SAMHSA or HHS for the opinions, resources, and medications described is intended to be or should be inferred. The information presented here in this document should not be considered medical advice and is not a substitute for individualized patient or client care and treatment decisions.
          </td>
        </tr>

        <tr>
          <td style="width:100%; color: #0a508c; font-size:22px; padding-left: 40px; padding-top: 10px;">
            <b>Public Domain Notice</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; color: #000; padding-left: 40px; padding-right: 40px;">
          All materials appearing in this volume except those taken directly from copyrighted sources are in the public domain and may be reproduced or copied without permission from SAMHSA or the authors. Citation of the source is appreciated. However, this publication may not be reproduced or distributed for a fee without the specific, written authorization of the Office of Communications, SAMHSA, HHS.
          </td>
        </tr>

        <tr>
          <td style="width:100%; color: #0a508c; font-size:22px; padding-left: 40px; padding-top: 10px;">
            <b>Electronic Access and Copies of Publication</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; color: #000; padding-left: 40px; padding-right: 40px;">
          This publication may be ordered from SAMHSA’s Publications Ordering Web page at <a style="text-decoration: underline">http://store.samhsa.gov</a>. Or, please call SAMHSA at 1-877- SAMHSA-7 (1-877-726-4727) (English).
          </td>
        </tr>

        <tr>
          <td style="width:100%; color: #0a508c; font-size:22px; padding-left: 40px; padding-top: 10px;">
            <b>Recommended Citation</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; color: #000; padding-left: 40px; padding-right: 40px;">
          Substance Abuse and Mental Health Services Administration. SAMHSA Opioid Overdose Prevention Toolkit. HHS Publication No. (SMA) 16-4742. Rockville, MD: Substance Abuse and Mental Health Services Administration, 2016.
          </td>
        </tr>

        <tr>
          <td style="width:100%; color: #0a508c; font-size:22px; padding-left: 40px; padding-top: 10px;">
            <b>Originating Office</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; color: #000; padding-left: 40px; padding-right: 40px;padding-bottom:50px;">
          Division of Pharmacologic Therapies, Center for Substance Abuse Treatment, Substance Abuse and Mental Health Services Administration, 1 Choke Cherry Road, Rockville, MD 20857. HHS Publication No. (SMA) 16-4742. First printed 2013. Revised 2014, 2016.
          </td>
        </tr>
      </table>


      <br>

      <table style="width:100%; color: #fff; background-color: #0a508c;">
        <tr>
          <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
            <b>TABLE OF CONTENTS</b>
          </td>
        </tr>
      </table>
      <table style="width:100%;">
        <tr>
          <td style="width:100%; color: #0a508c; padding-left: 40px; padding-top: 10px; padding-bottom: 20px; font-size:22px;">
            <b>SAMHSA Opioid Overdose Prevention Toolkit</b>
          </td>
        </tr>
        <tr>
          <td style="width:100%; padding-left: 40px; padding-bottom:250px;">
            <p><b>Facts for Community Members...................................................................................... 1</b></p>
            <p>&emsp;Scope Of The Problem........................................................................................................ 1</p>
            <p><b>Five Essential Steps for First Responders......................................................................... 2</b></p>
            <p>&emsp;Resources For Communities................................................................................................. 4</p>
            <p>&emsp;Step 1: Call For Help (Dial 911) ............................................................................................ 5</p>
            <p>&emsp;Step 2: Check For Signs Of Opioid Overdose ....................................................................... 5</p>
            <p>&emsp;Step 3: Support The Person’s Breathing ............................................................................... 6</p>
            <p>&emsp;Step 4: Administer Naloxone................................................................................................. 6</p>
            <p>&emsp;Step 5: Monitor The Person’s Response............................................................................... 7</p>
            <p>&emsp;Summary .............................................................................................................................. 8</p>

            <p><b>Information for Prescribers .................................................................................................... 9</b></p>
            <p>&emsp;Opioid Overdose................................................................................................................... 9</p>
            <p>&emsp;Treating Opioid Overdose ...................................................................................................14</p>
            <p>&emsp;Legal And Liability Considerations ......................................................................................16</p>
            <p>&emsp;Claims Coding And Billing...................................................................................................16</p>
            <p>&emsp;Resources For Prescribers..................................................................................................17</p>

            <p><b>Safety Advice for Patients & Family Members ....................................................................18</b></p>
            <p>&emsp;What Are Opioids?..............................................................................................................18</p>
            <p>&emsp;Preventing Overdose ..........................................................................................................18</p>
            <p>&emsp;If You Suspect An Overdose...............................................................................................18</p>
            <p>&emsp;What Is Naloxone?..............................................................................................................19</p>
            <p>&emsp;Report Any Side Effects ......................................................................................................19</p>
            <p>&emsp;Store Naloxone In A Safe Place..........................................................................................19</p>
            <p>&emsp;Summary: How To Avoid Opioid Overdose.........................................................................19</p>

            <p><b>Recovering From Opioid Overdose .....................................................................................20</b></p>
            <p>&emsp;Resources For Overdose Survivors And Family Members ..................................................20</p>
            <p>&emsp;Finding A Network Of Support.............................................................................................20</p>
            <p>&emsp;Resources...........................................................................................................................21</p>

            <p><b>References.............................................................................................................................22</b></p>
          </td>
        </tr>
      </table>

      <br>

      <table style="width:100%; color: #fff; background-color: #0a508c;">
        <tr>
          <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
            <b>FACTS FOR COMMUNITY MEMBERS</b>
          </td>
        </tr>
      </table>
      <table style="width:100%; padding-bottom:10px;font-size:14px;">
        <tr>
          <td style="width:60%; border-right:1px solid black;vertical-align: unset;">
            <b style="color: #0a508c; padding-left: 40px;  padding-right: 10px; padding-top: 10px; font-size:22px;">SCOPE OF THE PROBLEM</b>
            <P style="padding-left: 40px; padding-right: 10px;line-height: 10px;"><span style="color: #0a508c; font-size:80px; float: left; line-height: 1;">O</span><span>pioid overdose continues to be a major public health problem in the United States. It has contributed significantly to accidental deaths among those who use or misuse illicit and prescription opioids. In fact, U.S. overdose deaths involving prescription opioid analgesics increased to about 19,000 deaths in 20141,2 more than three times the number in 2001.1 According to Centers for Disease Control and Prevention (CDC) data, health care providers wrote 259 million prescriptions for painkillers in 2012, enough for every American adult to have a bottle of pills. 3-4</span></P>
            <br>
            <p style="padding-left: 40px; padding-right: 10px;"><b style="color: #0a508c;">WHAT ARE OPIOIDS?</b> Opioids include illegal drugs such as heroin, as well as prescription medications used to treat pain such as morphine, codeine, methadone, oxycodone (OxyContin®, Percodan®, Percocet®), hydrocodone (Vicodin®, Lortab®, Norco®), fentanyl (Duragesic®, Fentora®), hydromorphone (Dilaudid®, Exalgo®), and buprenorphine (Subutex®, Suboxone®).
            <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            Opioids work by binding to specific receptors in the brain, spinal cord, and gastrointestinal tract. In doing so, they minimize the body’s perception of pain. However, stimulating the opioid receptors or “reward centers” in the brain can also trigger other systems of the body, such as those responsible for regulating mood, breathing, and blood pressure.</p>
            <br>
            <p style="padding-left: 40px; padding-right: 10px;"><b style="color: #0a508c;">HOW DOES OVERDOSE OCCUR?</b> A variety of effects can occur after a person takes opioids, ranging from pleasure to nausea, vomiting, severe allergic reactions (anaphylaxis), and overdose, in which breathing and heartbeat slow or even stop.
            <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <br>
            Opioid overdose can occur when a patient deliberately misuses a prescription opioid or an illicit drug such as heroin. It can also occur when a patient takes an opioid as directed, but the prescriber miscalculated the opioid dose or an error was made by the dispensing pharmacist or the patient is understood the directions for use.
            <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <br>
            Also at risk are individuals who misuse opioids and combine them with sedative hypnotic agents resulting in sedation and respiratory depression.  5,6</p>
          </td>
          <td style="width:40%; font-size:14px; padding-left: 10px; vertical-align: unset;">
            <p><b style="color: #0a508c;">WHO IS AT RISK?</b> Anyone who uses opioids for long-term management of chronic cancer or non-cancer pain is at risk for opioid overdose, as are persons who use heroin. 7 Others at risk include</p>
            <p>persons who are:</p>
            <ul style="list-style-type: square; color:#0a508c;">
              <li><span style="color:#000; padding-left:10px;">Receiving rotating opioid medicationregimens (and thus are at risk forincomplete cross-tolerance).</span></li>
              <br>
              <li><span style="color:#000;padding-left:10px;">Discharged from emergency medical care following opioid intoxication or poisoning.</span></li>
              <br>
              <li><span style="color:#000;padding-left:10px;">At high risk for overdose because of a legitimate medical need for analgesia, coupled with a suspected or confirmed substance use disorder, or non-medical use of  rescription or illicit opioids.</span></li>
              <br>
              <li><span style="color:#000;padding-left:10px;">Completing mandatory opioid detoxification or abstinent for a period of time (and presumably with reduced opioid tolerance and high risk of relapse to opioid use).</span></li>
              <br>
              <li><span style="color:#000;padding-left:10px;">Recently released from incarceration and who have a history of opioid use disorder (and presumably have reduced opioid tolerance and high risk of relapse to opioid use).</span></li>
              <br>
            </ul>
            <table style="background-color: #0a508c; width:100%; padding:10px; color:#fff;text-align: center;">
              <tr>
                <td>
                <p>
                    <b>Tolerance</b> develops when someone uses an opioid drug regularly, so that their body becomes accustomed to the drug and needs a larger or more frequent dose to continue to experience the same effect.
                </p>
                <p>
                    <b>Loss of tolerance</b> occurs when someone stops taking an opioid after long-term use. When someone loses tolerance and then takes the opioid drug again, they
                    can experience serious adverse effects, including overdose, even if they take an
                    amount that caused them no problem in the past.
                </p>
              </td>
              </tr>
            </table>
          </td>
        <tr>
      </table>

      <br>

      <table style="width:100%; color: #fff; background-color: #0a508c;">
        <tr>
          <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
            <b>FIVE ESSENTIAL STEPS FOR FIRST RESPONDERS</b>
          </td>
        </tr>
      </table>
      <table style="width:100%; padding-bottom:10px;">
        <tr>
          <td style="padding-left: 40px; padding-top: 10px; color:#0a508c; font-size:22px;"><b>STRATEGIES TO PREVENT OVERDOSE DEATHS</b></td>
        </tr>
      </table>
      <table style="padding-bottom:50px;">
        <tr>
          <td style="width:85%; padding-left: 40px; padding-right:10px;">
            <p><b style="color:#0a508c;">STRATEGY 1: Encourage providers, persons at high risk, family members, and others to learn how to prevent and manage opioid overdose.</b> Providers should be encouraged to keep their knowledge current about evidence-based practices for the use of opioid analgesics to manage pain, as well as specific steps to prevent and manage opioid overdose.</p>
            <br>
            <p>&emsp;&emsp;Federally funded Continuing Medical Education courses are available to providers at no charge at <span style="text-decoration: underline">http://www.OpioidPrescribing.com</span> (a series of courses funded by the Substance Abuse and Mental Health Services Administration [SAMHSA]).</p>
            <br>
            <p>&emsp;&emsp;Helpful information for laypersons on how to prevent and manage overdose is available from Project Lazarus at <span style="text-decoration: underline">http://www.projectlazarus.org</span> or from the Massachusetts Health Promotion Clearinghouse at <span style="text-decoration: underline">http://www.maclearinghouse.org.</span> </p>
                <br>
            <p><b style="color:#0a508c;">STRATEGY 2: Ensure access to treatment for individuals who are misusing or addicted to opioids or who have other substance use disorders.</b> Effective treatment of substance use disorders can reduce the risk of overdose and help overdose survivors attain a healthier life. Medication-assisted treatment, as well as counseling and other supportive services, can be obtained at SAMHSA-certified and Drug Enforcement Administration (DEA)-registered opioid treatment programs (OTPs), as well as from physicians who are trained to provide care in office-based settings with medications such as buprenorphine and naltrexone.</p>
            <br>
            <p>Information on treatment services available in or near your community can be obtained from your state health department, your state alcohol and drug agency, or SAMHSA (see page 4).</p>
            <br>
            <p><b style="color:#0a508c;">STRATEGY 3: Ensure ready access to naloxone.</b> Opioid overdose-related deaths can be prevented when naloxone is administered in a timely manner. As a narcotic antagonist, naloxone displaces opiates from receptor sites in the brain and reverses respiratory depression that usually is the cause of overdose deaths.7 </p>
            <br>
            <p> &emsp;&emsp;On the other hand, naloxone is not effective in treating overdoses of benzodiazepines (such as Valium®, Xanax®, or Klonopin®), barbiturates (Seconal® or Fiorinal®), lonidine, Elavil®, GHB, ketamine, or synthetics. It is also not effective in overdoses with stimulants, such as cocaine and amphetamines (including methamphetamine and Ecstasy). However, if opioids are taken in combination with other sedatives or stimulants, naloxone may be helpful.<p>
            <br>
            <p>&emsp;&emsp;Naloxone injection has been approved by the United States Food and Drug Administration (FDA) and used for more than 40 years by emergency medical services(EMS) personnel to reverse opioid overdose and resuscitate persons who otherwise might have died in the absence of treatment.</p>
          </td>
          <td style="background-color:#0a508c;width:15%;padding-left:10px;padding-right:5px;">

            <p style="color:#fff; font-size: 16px; text-align:center;"><b>
              Encourage providers and others to learn about preventing and managing opioid overdose</b>
            </p>
            <br>
            <br>
            <br>
            <p style="color:#fff; font-size: 16px; text-align:center;"> <b> Ensure access to treatment for individuals who are misusing for addicted to opioids or who have other substance use disorders.</b></p>
          </td>
        </tr>
      </table>

      <table style="width:100%; color: #fff; background-color: #0a508c;">
        <tr>
          <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
            <b>FIVE ESSENTIAL STEPS FOR FIRST RESPONDERS</b>
          </td>
        </tr>
      </table>

      <table style="padding-bottom:250px;">
        <tr>
          <td style="width:85%; padding-left:40px;padding-right:10px;padding-top:10px;">
            <p style="font-size:19px;line-height:27px;">&emsp;&emsp;Naloxone does not have the potential for abuse. It reverses the effects of opioid overdose. 9 Injectable naloxone is relatively inexpensive. It typically is supplied as a kit with two syringes10 These kits require training on how to administer naloxone using a syringe. The FDA has also approved an intranasal naloxone product, called Narcan® Nasal Spray, and a naloxone auto-injector, called  Evzio®. The intranasal spray is a pre-filled, needle-free device that requires no assembly. The auto-injector can deliver a dose of naloxone through clothing, if necessary, when placed on the outer thigh.</p>
                <br>
            <p style="font-size:18px;line-height:27px;">&emsp;&emsp;Prior to 2012, just six states had any laws that expanded access to naloxone or limited criminal liability.11 Today, 42 states and the District of Columbia have statutes that provide criminal liability protections to laypersons or first  esponders who administer naloxone. Thirty-nine states and the District of Columbia have statutes that provide civil liability protections to laypersons or first responders who administer naloxone. Thirty-eight states have statutes that offer criminal liability protections for prescribing or distributing naloxone. Thirty-three states have statutes that offer civil liability protections for prescribing or distributing naloxone. And 42 states have statutes that allow naloxone distribution to third parties or first responders via direct prescription or standing order. To find states that have adopted relevant laws, visit the White House website at <span style="text-decoration: underline">www.whitehouse.gov/sites/default/files/ondcp/ </span>
            <span style="text-decoration: underline">Blog/naloxonecirclechart_january2016.pdf.</span></p>
                <br>
            <p style="font-size:19px;"><b style="color: #0a508c;">STRATEGY 4: Encourage the public to call 911.</b> An individual who is experiencing opioid overdose needs immediate medical attention. An essential first step is to get help from someone with medical expertise as quickly as possible.12-13 Therefore, members of the public should be encouraged to call 911. All they have to say is “Someone is not breathing” and give a clear address and location. Thirty-two states and the District of Columbia have “Good Samaritan” statutes that prevent arrest, charge, or prosecution for possession of a controlled substance or araphernalia if emergency assistance is sought for someone who is experiencing an opioid-induced overdose.</p>
            <br>
            <p style="font-size:19px;"><b style="color:#0a508c;">STRATEGY 5: Encourage prescribers to use state Prescription Drug Monitoring Programs.</b> State Prescription Drug Monitoring Programs (PDMPs) have emerged as a key strategy for addressing the misuse of prescription opioids and thus preventing opioid overdoses and deaths. Specifically, prescribers can check their state’s PDMP database to determine whether a patient is filling the prescriptions provided and/or obtaining prescriptions for the same or a similar drug from multiple prescribers.</p>
            <br>
            <p style="font-size:19px;margin-top:10px;">While nearly all states now have operational PDMPs, the programs differ from state to state in terms of the exact information collected, how soon that information is available to prescribers, and who may access the data. Therefore, information about the program in a particular state is best obtained directly from the state PDMP or from the board of medicine or pharmacy.</p>
          </td>

          <td style="background-color: #0a508c; width:15%; padding-left: 10px; padding-right:5px;padding-top:10px;">
            <br>
            <br>
            <p style="color:#fff; font-size: 19px; text-align:center;">
              <b>Encourage the public to call 911.</b>
            </p>
            <br>
            <br>

            <p style="color:#fff; font-size: 19px; text-align:center;">
              <b>Encourage prescribers to use state Prescription Drug Monitoring Programs.</b></p>
          </td>
        </tr>
      </table>

      <br>

      <table style="width:100%; color: #fff; background-color: #0a508c;">
        <tr>
          <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
            <b>FIVE ESSENTIAL STEPS FOR FIRST RESPONDERS</b>
          </td>
        </tr>
      </table>

      <table style="padding-bottom:500px;">
        <tr>
          <td style="width:85%;padding-left:40px;padding-right:10px;vertical-align:unset; ">
            <b style="color: #0a508c;font-size:25px;">RESOURCES FOR COMMUNITIES</b>
            <p style="font-size:16px;">Resources that may be useful to local communities and organizations are found at:</p>
            <p style="color: #0a508c;font-size:18px;"><b>Substance Abuse and Mental Health Services Administration (SAMHSA)</b></p>
            <ul style="list-style-type: square;font-size:16px; color: #0a508c;">
                <li ><span style="color:#000;">National Helpline:</span></li>
                <p style="color:#000;">1-800-662-HELP (4357) or 1-800-487-4889 (TDD — for hearing impaired)</p>
                <br>
                <li><span style="color:#000;">Behavioral Health Treatment Locator:</span></li>
                <p style="color:#000;color:#000;"><span style="text-decoration:underline;">https://findtreatment.samhsa.gov</span> to search by address, city, or zip code</p>
                <br>
                <li><span style="color:#000;">Buprenorphine Treatment Physician Locator:</span></li>
                <p style="text-decoration:underline;color:#000;">http://www.samhsa.gov/medication-assisted-treatment/physician-program-data/treatment-physician-locator</p>
                <br>
                <li><span style="color:#000;">State Substance Abuse Agencies:</span></li>
                <p style="text-decoration:underline;color:#000;">https://findtreatment.samhsa.gov/TreatmentLocator/faces/about.jspx</p>
                <br>
                <li><span style="color:#000;">Center for Behavioral Health Statistics and Quality (CBHSQ):</span></li>
                <p style="text-decoration:underline;color:#000;">http://www.samhsa.gov/data</p>
                <br>
                <li><span style="color:#000;">SAMHSA Publications:</span> <span style="text-decoration:underline;color:#000;">http://store.samhsa.gov</span></li>
                <p style="color:#000;">1-877-SAMHSA (1-877-726-4727)</p>
            </ul>
            <b style="color: #0a508c;">Centers for Disease Control and Prevention (CDC)</b>
            <p style="text-decoration:underline;color: #000;">http://www.cdc.gov/drugoverdose/epidemic</p>
            <p style="text-decoration:underline;color: #000;line-height: 0;">http://www.cdc.gov/homeandrecreationalsafety/poisoning</p>
            <br>
            <b style="color: #0a508c;">White House Office of National Drug Control Policy (ONDCP)</b>
            <p style="color: #000;">State and Local Information: <span style="text-decoration:underline;">http://www.whitehouse.gov/ondcp/state-map</span></p>
                <br>
            <b style="color: #0a508c;">Association of State and Territorial Health Officials</b>
            <p style="color: #000;">(ASTHO) ASTHO 214 Policy Inventory: State Action to Prevent and Treat Prescription Drug Abuse: <span style="text-decoration:underline;">http://www.astho.org/rx/profiles/Rx-Survey-Highlights</span></p>
            <br>
            <b style="color: #0a508c;">National Association of State Alcohol and Drug Abuse Directors (NASADAD)</b>
            <p style="color: #000;">Overview of State Legislation to Increase Access to Treatment for Opioid Overdose:</p>
            <p style="text-decoration:underline;color: #000;">http://nasadad.org/wp-content/uploads/2015/09/Opioid-Overdose-Policy-Brief-2015-Update-FINAL1.pdf</p>
            <br>
            <b style="color: #0a508c;">American Association for the Treatment of Opioid Dependence (AATOD)</b>
            <p style="color: #000;">Prevalence of Prescription Opioid Abuse:</p>
            <p style="text-decoration:underline;line-height: 0;color: #000;">http://www.aatod.org/projectseducational-training/prevalance-of-prescription-opioid-abuse</p>
          </td>

          <td style="background-color: #0a508c; width:15%; padding-left: 10px; padding-right:5px;">
            <br>
            <br>
            <p style="color:#fff; font-size: 16px; text-align:center;">
              <b>Resources that may be useful to local communities and organizations ...</b>
            </p>
            <br>
            <br>
          </td>
        </tr>
      </table>


      <br>

      <table style="width:100%; color: #fff; background-color: #0a508c;">
        <tr>
          <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
            <b>FIVE ESSENTIAL STEPS FOR FIRST RESPONDERS</b>
          </td>
        </tr>
      </table>
      <table style="width:100%; padding-bottom:100px;">
        <tr>&emsp;
          <td style="width:30%; vertical-align:unset; border-right: 1px solid black;">
            <P style="padding-left: 40px; padding-right: 10px;line-height: 22px;font-size:14px;"><span style="color: #0a508c; font-size:80px; float: left; line-height: 1;">O</span>
            <span>verdose is common among persons who use illicit opioids such as heroin and  among those who misuse medications prescribed for pain, such as oxycodone, hydrocodone, and morphine. The incidence of opioid overdose is rising nationwide. In 2014, 28,647 of drug overdose deaths involved some type of opioid, including heroin.14 U.S. overdose deaths involving prescription opioid analgesics increased to about 19,000 deaths in 20141,2 more than three times the number in 2001.1</span></p>
            <br>
            <p>&emsp; To address the problem, emergency medical personnel, health care professionals, and patients increasingly are being trained in the use of the opioid antagonist naloxone hydrochloride (naloxone), which is the treatment of choice to reverse the potentially fatal respiratory depression caused by opioid overdose. (Note that naloxone has no effect on non-opioid overdoses, such as those involving cocaine, benzodiazepines, or alcohol.)15</p>
            <br>
            <p>
                &emsp;The steps outlined below are recommended to reduce the number of deaths resulting from opioid overdoses2,6,10,16,17,18,19,20
            </p>
          </td>
          <td style="width:70%; vertical-align:unset; padding-left:10px; padding-right:10px;">
              <b style="color:#0a508c; font-size:23px;">STEP 1: CALL FOR HELP (DIAL 911)</b>
              <p>
                <b style="color:#0a508c; font-size:14px;">AN OPIOID OVERDOSE NEEDS IMMEDIATE MEDICAL ATTENTION.</b> An essential step is to get someone with medical
                expertise to see the patient as soon as possible, so if no emergency
                medical services (EMS) or other trained personnel are on the scene,
                dial 911 immediately. All you have to say is “Someone is not
                breathing.” Be sure to give a clear address and/or description of your
                location.
              </p>
              <br>
              <b style="color:#0a508c; font-size:23px;">STEP 2: CHECK FOR SIGNS OF OPIOID OVERDOSE</b>
              <p style="#000;">Signs of <b style="color: #0a508c;">OVERDOSE</b>, which often results in death if not treated, include15:</p>
              <ul style="list-style-type: square; color:#0a508c;">
                <li><span style="color:#000;">Extreme sleepiness, inability to awaken verbally or upon sternal rub.</span></li>
                <li><span style="color:#000;">Breathing problems that can range from slow to shallow breathing in a patient that cannot be awakened.</span></li>
                <li><span style="color:#000;">Fingernails or lips turning blue/purple.</span></li>
                <li><span style="color:#000;">Extremely small “pinpoint” pupils.</span></li>
                <li><span style="color:#000;">Slow heartbeat and/or low blood pressure.</span></li>
              </ul>
              <p>Signs of <b style="color: #0a508c;">OVERMEDICATION</b>, which may progress to overdose, include:15</p>
              <ul style="list-style-type: square; color:#0a508c;">
                <li><span style="color:#000;">Unusual sleepiness, drowsiness, or difficulty staying awake despite loud verbal stimulus or vigorous sternal rub.</span></li>
                <li><span style="color:#000;">Mental confusion, slurred speech, intoxicated behavior.</span></li>
                <li><span style="color:#000;">Slow or shallow breathing.</span></li>
                <li><span style="color:#000;">Extremely small “pinpoint” pupils, although normal size pupils do not exclude opioid overdose.</span></li>
                <li><span style="color:#000;">Slow heartbeat, low blood pressure.</span></li>
                <li><span style="color:#000;">Difficulty waking the person from sleep.</span></li>
              </ul>
              <br>
              <p style="color:#000;">
                &emsp;Because opioids depress respiratory function and breathing, one
                telltale sign of a person in a critical medical state is the “death rattle.”
                If a person emits a “death rattle”—an exhaled breath with a very
                distinct, labored sound coming from the throat—emergency
                resuscitation will be necessary immediately, as such a sound almost
                always is a sign that the individual is near death.17
              </p>
          </td>
        </tr>
      </table>

      <br>
          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>FIVE ESSENTIAL STEPS FOR FIRST RESPONDERS</b>
              </td>
            </tr>
          </table>

          <table style="width:100%; padding-bottom:250px;">
            <tr>&emsp;
              <td style="width:60%; border-right:1px solid black;  padding-right:10px;vertical-align:unset;">
                  <b style="color:#0a508c; font-size:25px;">STEP 3: SUPPORT THE PERSON’S BREATHING</b>
                  <p>Ventilatory support is an important intervention and may be life- saving on its own. Patients should be ventilated with oxygen prior to administration of naloxone. 2,6 In situations where oxygen is not available, rescue breathing can be very effective in supporting respiration.2 Rescue breathing for adults involves the following steps:</p>
                  <ul style="list-style-type: square; color:#0a508c;">
                    <li><span style="color:#000;">Be sure the person’s airway is clear (check that nothing inside the person’s mouth or throat is blocking the airway).</span></li>
                    <li><span style="color:#000;">Place one hand on the person’s chin, tilt the head back and pinch the nose closed.</span></li>
                    <li><span style="color:#000;">Place your mouth over the person’s mouth to make a seal and give 2 slow breaths.</span></li>
                    <li><span style="color:#000;">The person’s chest should rise (but not the stomach).</span></li>
                    <li><span style="color:#000;">Follow up with one breath every 5 seconds.</span></li>
                  </ul>
                  <b style="color:#0a508c; font-size:25px;">STEP 4: ADMINISTER NALOXONE</b>
                  <p>&emsp;Any patient who presents with signs of opioid overdose, or when
                  this is suspected, should be administered naloxone. Naloxone
                  injection is approved by the FDA and has been used for decades by
                  EMS personnel to reverse opioid overdose and resuscitate
                  individuals who have overdosed on opioids</p><br>
                  <p>&emsp;Naloxone can be given by intranasal spray, intramuscular (into
                  the muscle), subcutaneous (under the skin), or intravenous
                  injection.17-19</p><br>
                  <p>&emsp;The most rapid onset of action is achieved by
                  intravenous administration, which is recommended in emergency
                  situations.17 The dose should be titrated to the smallest effective dose
                  that maintains spontaneous normal respiratory drive.</p>
                  <p>&emsp; Opioid-naive patients may be given starting doses of up to 2 mg
                  without concern for triggering withdrawal symptoms depending on the
                  route of administration.2,9,18</p>
                  <br>
                  <p>&emsp;The intramuscular route of administration for naloxone may be
                  suitable for patients with suspected opioid use disorder because it
                  provides a slower onset of action and a prolonged duration of effect,
                  which may minimize rapid onset of withdrawal symptoms.2,5,10</p>
                  <br>
                  <p><b style="color:#0a508c;">DURATION OF EFFECT.</b> The duration of effect of naloxone is 20 to 90 minutes depending on dose and route of administration6, and overdose symptoms.5,17,18 The goal of naloxone therapy should be to restore adequate spontaneous breathing, but not necessarily complete arousal.</p>
              </td>
              <td style="width:40%; vertical-align:unset; padding-left:10px; padding-right:10px;">
                  <p>&emsp;More than one dose of naloxone may be needed to revive someone who is overdosing. Patients who have taken longer-acting opioids may require further intravenous bolus doses or an infusion of naloxone.21</p>
                  <br>
                  <p>&emsp; Comfort the person being treated, as withdrawal triggered by naloxone can feel unpleasant. As a result, some persons become agitated or combative when this happens and need help to remain calm.</p>
                  <br>
                  <p>
                    <b style="color:#0a508c;">SAFETY OF NALOXONE.</b>
                    The safety profile of naloxone is remarkably high, especially when used in low doses and titrated to effect.2,9,17,22 When given to individuals who are not opioid-intoxicated or opioid-dependent, naloxone produces no clinical effects, even at high doses. Moreover, although rapid opioid withdrawal in tolerant patients may be unpleasant, it is not life-threatening.</p>
                    <br>
                    <p>&emsp;Naloxone can be used in life-threatening opioid overdose circumstances in pregnant women.23 </p>
                    <br>
                    <p>&emsp;The FDA has approved injectable naloxone, intranasal naloxone (called Narcan®
                    Nasal Spray), and a naloxone auto-injector (called Evzio®1) The currently available naloxone kits that include a syringe and naloxone ampules or vials or a prefilled naloxone</p>
              </td>
            </tr>
          </table>

          <br>

          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>FIVE ESSENTIAL STEPS FOR FIRST RESPONDERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%; padding-bottom:150px;">
          <tr>&emsp;
            <td style="width:70%; border-right:1px solid black;font-size:14px; padding-right:10px;vertical-align:unset;">
              <p>
                syringe and a mucosal atomizer device to enable intranasal delivery
                require the user to be trained on how to assemble all of the materials
                and administer the naloxone to the victim. The Narcan Nasal Spray is
                a pre-filled, needle-free device that requires no assembly, which can
                deliver a single dose into one nostril. The Evzio auto-injector is
                injected into the outer thigh to deliver naloxone to the muscle
                (intramuscular) or under the skin (subcutaneous). Once turned on,
                the device provides verbal instruction to the user describing how to
                deliver the medication, similar to automated defibrillators. Both
                Narcan Nasal Spray and Evzio are packaged in a carton containing
                two doses, to allow for repeat dosing if needed.</p>
                 <br>
                <b style="color:#0a508c; font-size:25px;">STEP 5: MONITOR THE PERSON’S RESPONSE</b>
                <p>&emsp;All patients should be monitored for recurrence of signs and
                symptoms of opioid toxicity for at least 4 hours from the last dose of
                naloxone or discontinuation of the naloxone infusion. Patients who
                have overdoses on long-acting opioids should have more prolonged
                monitoring.2,10</p>
                <br>
                <p>&emsp;Most patients respond by returning to spontaneous breathing.
                The response generally occurs within 3 to 5 minutes of naloxone
                administration. (Continue rescue breathing while waiting for the
                naloxone to take effect.)2,5,10</p>
                <br>
                <p>&emsp;
                Naloxone will continue to work for 30 to 90 minutes, but after that
                time, overdose symptoms may return.17,18Therefore, it is essential to
                get the person to an emergency department or other source of
                medical care as quickly as possible, even if he or she revives after
                the initial dose of naloxone and seems to feel better.</p>
                <br>
                <p><b style="color:#0a508c;">SIGNS OF OPIOID WITHDRAWAL.</b> The signs and symptoms of
                opioid withdrawal in an individual who is physically dependent on
                opioids may include, but are not limited to, the following: body aches,
                diarrhea, tachycardia, fever, runny nose, sneezing, piloerection,
                sweating, yawning, nausea or vomiting, nervousness, restlessness or
                irritability, shivering or trembling, abdominal cramps, weakness, and
                increased blood pressure. In the neonate, opioid withdrawal may also
                include convulsions, excessive crying, and hyperactive reflexes.17
              </p>
            </td>
            <td style="width:30%; vertical-align:unset; font-size:13px; padding-left:10px;padding-right:10px;">
              <p>
                <b style="color:#0a508c;">NALOXONE NON-
                RESPONDERS</b>. If a patient
                does not respond to naloxone,
                an alternative explanation for
                the clinical symptoms should
                be considered. The most likely
                explanation is that the person
                is not overdosing on an opioid
                but rather some other
                substance or may even be
                experiencing a non-overdose
                medical emergency. A
                possible explanation to
                consider is that the individual
                has overdosed on
                buprenorphine, a long-acting
                opioid partial agonist. Because
                buprenorphine has a higher
                affinity for the opioid receptors
                than do other opioids,
                naloxone may not be effective
                at reversing the effects of
                buprenorphine-induced opioid
                overdose.
              </p>
              <br>
              <p>&emsp;
                In all cases, support of
                ventilation, oxygenation, and
                blood pressure should be
                sufficient to prevent the
                complications of opioid
                overdose and should be given
                priority if the response to
                naloxone is not prompt.
              </p>
            </td>
          </tr>
          </table>
          <br>
          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>FIVE ESSENTIAL STEPS FOR FIRST RESPONDERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:450px;">
            <tr>
              <td style="padding-left:40px;">
                  <b style="color:#0a508c; font-size:25px;">SUMMARY</b>
                  <p><b style="color:#0a508c;">Do’s and Don’ts in Responding to Opioid Overdose</b></p>
                  <ul style="list-style-type: square; color:#0a508c;">
                    <li><span style="color:#000;">DO support the person’s breathing by administering oxygen or performing rescue breathing.</span></li>
                    <br>
                    <li><span style="color:#000;">DO administer naloxone.</span></li>
                    <br>
                    <li><span style="color:#000;">DO put the person in the “recovery position” on the side, if he or she is breathing independently.</span></li>
                    <br>
                    <li><span style="color:#000;">DO stay with the person and keep him/her warm.</span></li>
                    <br>
                    <li><span style="color:#000;">DON’T slap or try to forcefully stimulate the person—it will only cause further injury. If you are unable to wake the person by shouting, rubbing your knuckles on the sternum (center of the chest or rib cage), or light pinching, he or she may be unconscious.</span></li>
                    <br>
                    <li><span style="color:#000;">DON’T put the person into a cold bath or shower. This increases the risk of falling, drowning, or going into shock.</span></li>
                    <br>
                    <li><span style="color:#000;">DON’T inject the person with any substance (saltwater, milk, “speed,” heroin, etc.). The only safe and appropriate treatment is naloxone.</span></li>
                    <br>
                    <li><span style="color:#000;">DON’T try to make the person vomit drugs that he or she may have swallowed. Choking or inhaling vomit into the lungs can cause a fatal injury.</span></li>
                    <br>
                  </ul>
                  <br>
                  <p><b style="color:#0a508c;">NOTE:</b> All naloxone products have an expiration date, so it is important to check the expiration date and
obtain replacement naloxone as needed.</p>
              </td>
            </tr>
          </table>

          <br>

          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:100px;">
            <tr>&emsp;
              <td style="width:70%; padding-right:10px;border-right:1px solid black;vertical-align:unset;padding-left: 40px; padding-right: 10px;">
                <P style="line-height: 27px;"><span style="color: #0a508c; font-size:80px; float: left; line-height: 1;">O</span><span>pioid overdose is a major public health problem. In 2014, 28,647 of drug overdose deaths involved some type of opioid, including heroin. 14,19 Overdose involves both men and women of all ages, ethnicities, and demographic and economic characteristics, and involves both illicit opioids such as heroin and, increasingly, prescription opioid analgesics such as oxycodone, hydrocodone, fentanyl, and methadone.4</span></p>
                <p>&emsp;Physicians and other health care providers can make a major contribution toward reducing the toll of opioid overdose through the care they take in prescribing opioid analgesics and monitoring patients’ response, as well as through their acuity in identifying and effectively addressing opioid overdose. Federally funded Continuing Medical Education (CME) courses are available at no charge at <span style="text-decoration: underline;">http://www.OpioidPrescribing.com</span> (a series of courses funded by the Substance Abuse and Mental Health Services Administration [SAMHSA])2.
                </P>
                <b style="color: #0a508c; font-size:25px;">OPIOID OVERDOSE</b>
                <p>&emsp;The risk of opioid overdose can be minimized through adherence to the following clinical practices, which are supported by a considerable body of evidence. 2,10,22,24</p>
                <p><b style="color: #0a508c;">ASSESS THE PATIENT</b>. Obtaining a history of the patient’s past use of drugs (either illicit drugs or prescribed medications with misuse potential) is an essential first step in appropriate prescribing. Such a history should include very specific questions. For example:</p>
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">“In the past 6 months, have you taken any medications to help you calm down, keep from getting nervous or upset, raise your spirits, make you feel better, and the like?”</span></li>
                  <li><span style="color:#000;">“Have you been taking any medications to help you sleep? Have you been using alcohol for this purpose?”</span></li>
                  <li><span style="color:#000;">“Have you ever taken a medication to help you with a drug or alcohol problem?”</span></li>
                  <li><span style="color:#000;">“Have you ever taken a medication for a nervous stomach?”</span></li>
                  <li><span style="color:#000;">“Have you taken a medication to give you more energy or to cut down on your appetite?”</span></li>
                  <li><span style="color:#000;">“Have you ever been treated for a possible or suspected opioid overdose?”</span></li>
                </ul>
              </td>
              <td style="width:30%;padding-left:10px;padding-right:10px;font-size:13px;">
                  <p>
                  The patient history should also include questions about use of alcohol and over-the- counter (OTC) preparations. For example, the ingredients in many common cold preparations include alcohol and other central nervous system (CNS) depressants, so these products should not be used in combination with opioid analgesics.
                  Positive answers to any of these questions warrant further investigation.</p>
                  <p><b style="color:#0a508c;">TAKE SPECIAL PRECAUTIONS WITH NEW PATIENTS.</b> Many experts recommend that additional precautions be taken in pre-scribing opioid analgesics for new patients.22 These might involve the following:
                    <p>1.<b style="color:#0a508c;">Assessment:</b> In addition to doing the patient history and examination, the physician should determine who has been caring for the patient in the past, what medications have been prescribed and for what indications, what substances (including alcohol, illicit drugs, and OTC products) the patient has reported using, and when and what amount was last used and by what route. Medical records should be obtained (with the patient’s consent).
                    </p>
                    <p>2.<b style="color:#0a508c;">Emergencies:</b> In emergency situations, the physician should prescribe the smallest possible quantity, typically not exceeding 3 days’ supply, and arrange for a
                  </p>
              </td>
            </tr>
          </table>

          <br>

          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:150px;">
            <tr>&emsp;
              <td style="width:70%; vertical-align:unset; border-right:1px solid black;">
              <p>return visit the next day. In addition, consider prescribing naloxone to help mitigate risk associated with these emergent situations. At a minimum, the patient’s identity should be verified by asking for proper identification.</p>
              <p>
              3.<b style="color:#0a508c;">Non-emergencies:</b> In non-emergency situations, only enough
              of an opioid analgesic should be prescribed to meet the
              patient’s needs until the next appointment. The patient should
              be directed to return to the office for additional prescriptions,
              as telephone orders do not allow the physician to reassess the
              patient’s continued need for the medication.</p>
              <p><b style="color:#0a508c;">STATE PRESCRIPTION DRUG MONITORING
              PROGRAMS.</b> State Prescription Drug Monitoring Programs
              (PDMPs) have emerged as a key strategy for addressing the
              misuse of prescription opioids and thus preventing opioid
              overdoses and deaths. Specifically, prescribers can check their
              state’s PDMP database to determine whether a patient is filling
              the prescriptions provided and/or obtaining prescriptions for the
              same or similar drugs from multiple physicians.</p>
              <p>&emsp;While nearly all states now have operational PDMPs, the
              programs differ from state to state in terms of the exact
              information collected, how soon that information is available to
              physicians, and who may access the data. Therefore,
              information about the program in a particular state is best
              obtained directly from the PDMP or from the state board of
              medicine or pharmacy.</p>
              <p><b style="color:#0a508c;">SELECT AN APPROPRIATE MEDICATION.</b> Rational drug
              therapy demands that the efficacy and safety of all potentially
              useful medications be reviewed for their relevance to the
              patient’s disease or disorder.2,22</p>
              <p>&emsp;When an appropriate medication has been selected, the
              dose, schedule, and formulation should be determined. These
              choices often are just as important in optimizing
              pharmacotherapy as the choice of medication itself. Decisions
              involve (1) dose (based not only on age and weight of the
              patient, but also on severity of the disorder, possible loading-
              dose requirement, and the presence of potentially interacting
              drugs); (2) timing of administration (such as a bedtime dose to
              minimize problems associated with sedative or respiratory
              depressant effects); (3) route of administration (chosen to
              improve compliance/adherence as well as to attain peak drug
              concentrations rapidly); and (4) formulation (e.g., selecting a
              patch in preference to a tablet, or an extended-release product
              rather than an immediate-release formulation).</p>
              </td>
              <td style="width:30%;font-size:13px;padding-left:10px;padding-right:10px;vertical-align:unset;">
              <p>Even when sound medical
                indications have been established,
                physicians typically consider three
                additional factors before deciding
                to prescribe an opioid analgesic2,22:</p>
                <p>1. The <b style="color:#0a508c;">severity of symptoms,</b> in
                terms of the patient’s ability to
                accommodate them. Relief of
                symptoms is a legitimate goal
                of medical practice, but using
                opioid analgesics requires
                caution.</p>
                <p>2. The patient’s <b style="color:#0a508c;">reliability in taking
                medications,</b> noted through
                observation and careful history-
                taking. The physician should
                assess a patient’s history of
                and risk factors for substance
                use disorders before
                prescribing any psychoactive
                drug and weigh the benefits
                against the risks. The likely
                development of physical
                dependence in patients on
                long-term opioid therapy should
                be monitored through periodic
                checkups.</p>
                <p>3. The <b style="color:#0a508c;">dependence-producing
                potential of the medication.</b> The
                physician should consider
                whether a product with less
                potential for misuse, or even a
                non-drug therapy, would
                provide equivalent benefits.
                Patients should be warned
                about possible adverse effects
                caused by inter- actions
                between opioids and other
                medications or substances,
                including alcohol. At the time a
                drug is prescribed, patients
                should be informed that it is
                illegal to sell, give away, or
                otherwise share their
                medication with others,</p>
              </td>
            </tr>
          </table>


          <br>


          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>&emsp;
              <td style="width:70%;vertical-align:unset;border-right:1px solid black;">
              <p>including family members. The patient’s obligation extends to
              keeping the medication in a locked cabinet or otherwise
              restricting access to it and to safely disposing of any unused
              supply (visit http://www.fda.gov/ForConsumers/Consumer-
              Updates/ucm101653.htm for advice from the United States
              Food and Drug Administration (FDA) on how to safely
              dispose of unused medications).</p>
              <p><b style="color:#0a508c;">EDUCATE THE PATIENT AND OBTAIN INFORMED CONSENT.</b>Obtaining informed consent involves informing the patient about the risks and benefits of the proposed therapy and of the ethical and legal obligations such therapy imposes on both physician and patient. 22 Such informed consent can serve multiple purposes: (1) it provides the patient with information about the risks and benefits of opioid therapy; (2) it fosters adherence to the treatment plan; it limits the potential for inadvertent drug misuse; and (4) it improves the efficacy of the treatment program. </p>

              <p>&emsp;Patient education and informed consent should specifically address the potential for physical dependence and cognitive impairment as side effects of opioid analgesics.3</p>
              <p>Other issues that should be addressed in the informed consent or treatment agreement include the following22:</p>
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">The agreement instructs the patient to stop taking all other pain medications, unless explicitly told to continue by the physician. Such a statement reinforces the need to adhere to a single treatment regimen.</span></li>
                  <li><span style="color:#000;">The patient agrees to obtain the prescribed medication from only one physician and, if possible, from one designated pharmacy.</span></li>
                  <li><span style="color:#000;">The patient agrees to take the medication only as prescribed (for some patients, it may be possible to offer latitude to adjust the dose as symptoms dictate).</span></li>
                  <li><span style="color:#000;">The agreement makes it clear that the patient is responsible for safeguarding the written prescription and the supply of medications, and arranging refills during regular office hours. This  responsibility includes planning ahead so as not to run out of medication during weekends or vacation.</span></li>
                  <li><span style="color:#000;">The agreement specifies the consequences for failing to ad-here to the treatment plan, which may include</span></li>
                </ul>
              </td>
              <td style="width:30%;font-size:13px;padding-left:10px;padding-right:10px;vertical-align:unset;">
                <p>discontinuation of opioid
                therapy if the patient’s actions
                compromise his or her safety.</p>
                <p>&emsp;Both patient and physician
                should sign the informed con- sent
                agreement, and a copy should be
                placed in the patient’s medical
                record. It also is helpful to give the
                patient a copy of the agreement to
                carry with him or her, to document
                the source and reason for any
                controlled drugs in his or her
                possession.</p>
                <p>&emsp;Some physicians provide a
                laminated card that identifies the
                individual as a patient of their
                practice. This is helpful to other
                physicians who may see the
                patient and in the event the patient
                is seen in an emergency
                department.</p>
                <b style="color:#0a508c;">EXECUTE THE PRESCRIPTION ORDER.</b> Careful execution of the
                prescription order can prevent
                manipulation by the patient or
                others intent on obtaining opioids
                for non-medical purposes. For
                example, federal law requires that
                prescription orders for controlled
                substances be signed and dated
                on the day they are issued. Also
                under federal law, every
                prescription or der must include at
                least the following information:
                  <ul style="list-style-type: square; color:#0a508c;">
                    <li><span style="color:#000;">Name and address of the patient</span></li>
                    <li><span style="color:#000;">Name, address, and DEA registration number of the physician</span></li>
                  </ul>
              </td>
            </tr>
          </table>


          <br>


          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>&emsp;
              <td style="width:70%;vertical-align:unset;border-right:1px solid black;">
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Signature of the physician</span></li>
                  <li><span style="color:#000;">Name and quantity of the drug prescribed</span></li>
                  <li><span style="color:#000;">Directions for use</span></li>
                  <li><span style="color:#000;">Refill information</span></li>
                  <li><span style="color:#000;">Effective date if other than the date on which the prescription was written</span></li>
                </ul>
                <p>&emsp;Many states impose additional requirements, which the
                physician can determine by consulting the state medical
                licensing board. In addition, there are special federal
                requirements for drugs in different schedules of the federal
                Controlled Substances Act (CSA), particularly those in Schedule
                II, where many opioid analgesics are classified.</p>

                <p>&emsp;Blank prescription pads as well as information such as the
                names of physicians who recently retired, left the state, or died
                all can be used to forge prescriptions. Therefore, it is a sound
                practice to store blank prescriptions in a secure place rather than
                leaving them in examining rooms.</p>

                <p><b style="color:#0a508c;">NOTE:</b> The physician should immediately report the theft or loss
                of prescription blanks to the nearest field office of the federal
                Drug Enforcement Administration and to the state board of
                medicine or pharmacy.</p>

                <p><b style="color:#0a508c;">MONITOR THE PATIENT’S RESPONSE TO TREATMENT.</b>
                Proper prescription practices do not end when the patient
                receives a prescription. Plans to monitor for drug efficacy and
                safety, compliance, and potential development of tolerance must
                be documented and clearly communicated to the patient.2</p>

                <p>&emsp;Subjective symptoms are important in monitoring, as are
                objective clinical signs (such as body weight, pulse rate,
                temperature, blood pressure, and levels of drug metabolites in
                the bloodstream). These can serve as early signs of therapeutic
                failure or unacceptable adverse drug reactions that require
                modification of the treatment plan.</p>

                <p>&emsp;Asking the patient to keep a log of signs and symptoms gives
                him or her a sense of participation in the treatment program and
                facilitates the physician’s review of therapeutic progress and
                adverse events.</p>

                <p>&emsp;Simply recognizing the potential for non-adherence,
                especially during prolonged treatment, is a significant step
                toward improving medication use25. Steps such as simplifying
                the drug regimen and offering patient education also improve
                adherence, as do phone calls to patients, home visits by nursing
                personnel, convenient packaging of medication, and periodic</p>
              </td>
              <td style="width:30%;font-size:13px;padding-left:10px;padding-right:10px;vertical-align:unset;">
                <p>urine testing for the prescribed opioid as well as any other respiratory depressant.</p>

                <p>&emsp;Finally, the physician should convey to the patient through attitude and manner that any medication, no matter how helpful, is only part of an overall treatment plan.</p>

                <p>&emsp;When the physician is concerned about the behavior or clinical progress (or lack thereof) of a patient being treated with an opioid analgesic, it usually is advisable to seek a consultation with an expert in the disorder for which the patient is being treated and an expert in addiction. Physicians place themselves at risk if they continue to prescribe opioids in the absence of such consultations.22</p>

                <p><b style="color:#0a508c;">CONSIDER PRESCRIBING NALOXONE ALONG WITH THE PATIENT’S INITIAL OPIOID PRESCRIPTION.</b> Naloxone competitively binds opioid receptors and is the antidote to acute opioid toxicity. With proper education, patients on long-term opioid therapy and others at risk for overdose may benefit from being
                prescribed (1) a naloxone kit containing naloxone, syringes, and needles; (2) Narcan® Nasal Spray, which delivers a single dose of naloxone into one nostril via a pre-filled intranasal spray; or (3)</p>
              </td>

            </tr>
          </table>

          <br>

          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>&emsp;
              <td style="width:70%; vertical-align:unset;border-right:1px solid black;">
                Evzio®,4 which delivers a single dose of naloxone to the outer thigh via a hand-held auto-injector. 5,9
                <p>Patients who are candidates for such kits include those who are:</p>
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Taking high doses of opioids for long-term management of chronic malignant or non-malignant pain.</span></li>
                  <li><span style="color:#000;">Receiving rotating opioid medication regimens (and thus are at risk for incomplete cross-tolerance).</span></li>
                  <li><span style="color:#000;">Discharged from emergency medical care following opioid intoxication or poisoning.</span></li>
                  <li><span style="color:#000;">At high risk for overdose because of a legitimate medical need for analgesia, coupled with a suspected or confirmed history of substance use disorder or non-medical use of prescription or illicit opioids.</span></li>
                  <li><span style="color:#000;">On certain opioid preparations that may increase risk for opioid overdose such as extended release/long-acting preparations.</span></li>
                  <li><span style="color:#000;">Completing mandatory opioid detoxification or abstinence programs.</span></li>
                  <li><span style="color:#000;">Recently released from incarceration and with a history of opioid use disorder (and presumably with reduced opioid tolerance and high risk of relapse to opioid use).</span></li>
                </ul>
                <p>&emsp;It may also be advisable to suggest that the at-risk patient
                create an “overdose plan” to share with friends, partners, and/or
                caregivers. Such a plan would contain information on the signs
                of overdose and how to administer naloxone or otherwise
                provide emergency care (as by calling 911).</p>

                <b style="color:#0a508c;">DECIDE WHETHER AND WHEN TO END OPIOID
                THERAPY</b>. Certain situations may warrant immediate cessation
                of prescribing. These generally occur when out-of-control
                behaviors indicate that continued prescribing is unsafe or
                causing harm to the patient.2 Examples include altering or selling
                prescriptions, accidental or intentional overdose, multiple
                episodes of running out early (due to excessive use), doctor
                shopping, or engaging in threatening behavior.
                <p>&emsp;When such events arise, it is important to separate the
                patient as a person from the behaviors caused by the disease of
                addiction, as by demonstrating a positive regard for the person
                but no tolerance for the aberrant behaviors.</p>
                <p>&emsp;In such a situation, the essential steps are to (1) stop
                prescribing, (2) tell the patient that continued prescribing is not</p>
              </td>

              <td style="width:30%;font-size:13px;padding-left:10px;padding-right:10px;vertical-align:unset;">
                <p>clinically supportable (and thus not
                possible), (3) urge the patient to
                accept a referral for assessment by
                an addiction specialist, (4) educate
                the patient about signs and
                symptoms of spontaneous
                withdrawal and urge the patient to
                go to the emergency department if
                withdrawal symptoms occur, (5)
                retrain on the risks and the signs of
                opioid overdose and on the use of
                naloxone and consider prescribing
                naloxone if deemed appropriate,
                and (6) assure the patient that he
                or she will continue to receive care
                for the presenting symptoms or
                condition.22</p>

                <p>&emsp;Identification of a patient who is
                misusing a prescribed opioid
                presents a major therapeutic
                opportunity. The physician should
                have a plan for managing such a
                patient, typically involving work with
                the patient and the patient’s family,
                referral to an addiction expert for
                assessment and placement in a
                formal addiction treatment
                program, long-term participation in
                a 12-Step mutual-help program
                such as Narcotics Anonymous, and
                follow-up of any associated
                medical or psychiatric
                comorbidities.2</p>

                <p>&emsp;Providing training on use of
                naloxone and prescribing a
                naloxone kit or FDA-approved
                naloxone should be considered.</p>

                <p>&emsp;In all cases, patients should be
                given the benefit of the physician’s
                concern and attention. It is
                important to remember that even
                drug-seeking patients often have</p>
              </td>
            </tr>
          </table>
        <br>
          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>&emsp;
              <td style="width:70%;vertical-align:unset;border-right:1px solid black;">
                <p>very real medical problems that demand and deserve the same high-quality medical care offered to any patient.2,22</p>
                <p><b style="color:#0a508c;">TREATING OPIOID OVERDOSE</b></p>
                <p>&emsp;In the time it takes for an overdose to become fatal, it is
                possible to reverse the respiratory depression and other effects
                of opioids through respiratory support and administration of the
                opioid antagonist naloxone. 17 Naloxone is approved by the FDA
                and has been used for decades to reverse overdose and
                resuscitate individuals who have overdosed on opioids. The
                routes of administration for naloxone are intravenous, intranasal,
                intramuscular, and subcutaneous.</p>

                <p>&emsp;The safety profile of naloxone is remarkably high, especially
                when used in low doses and titrated to effect.6,17 If given to
                individuals who are not opioid-intoxicated or opioid-dependent,
                naloxone produces no clinical effects, even at high doses.
                Moreover, while rapid opioid withdrawal in tolerant patients may
                be unpleasant, it is not typically life-threatening.</p>

                <p>&emsp;Naloxone should be part of an overall approach to known or suspected opioid overdose that incorporates the steps below.</p>

                <p><b style="color:#0a508c;">RECOGNIZE THE SIGNS OF OVERDOSE.</b>An opioid overdose requires rapid diagnosis. The most common signs of overdose include2:</p>
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Extreme sleepiness, inability to awaken verbally or upon sternal rub.</span></li>
                  <li><span style="color:#000;">Breathing problems that can range from slow to shallow breathing in a patient who cannot be awakened.</span></li>
                  <li><span style="color:#000;">Fingernails or lips turning blue/purple.</span></li>
                  <li><span style="color:#000;">Extremely small “pinpoint” pupils.</span></li>
                  <li><span style="color:#000;">Slow heartbeat and/or low blood pressure.</span></li>
                </ul>
                Signs of <b style="color:#0a508c;">OVERMEDICATION</b>, which may progress to overdose, include2:
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Unusual sleepiness, drowsiness, or difficulty staying awake despite loud verbal stimulus or vigorous sternal rub.</span></li>
                  <li><span style="color:#000;">Mental confusion, slurred speech, intoxicated behavior.</span></li>
                  <li><span style="color:#000;">Slow or shallow breathing.</span></li>
                  <li><span style="color:#000;">Pinpoint (small) pupils; normal size pupils does not exclude opioid overdose.</span></li>
                  <li><span style="color:#000;">Slow heartbeat, low blood pressure.</span></li>
                  <li><span style="color:#000;">Difficulty waking the person from sleep.</span></li>
                </ul>
              </td>

              <td style="width:30%;font-size:13px;padding-left:10px;padding-right:10px;vertical-align:unset;">
              <p>Because opioids depress
              respiratory function and breathing,
              one telltale sign of an individual in
              a critical medical state is the “death
              rattle.” This is an exhaled breath
              with a very distinct, labored sound
              coming from the throat. It indicates
              that emergency resuscitation is
              needed immediately.26</p>

              <p><b style="color:#0a508c;">SUPPORT RESPIRATION.</b>
              Supporting respiration is the single
              most important intervention for
              opioid overdose and may be life-
              saving on its own. Ideally,
              individuals who are experiencing
              opioid overdose should be
              ventilated with oxygen before
              naloxone is administered to reduce
              the risk of acute lung injury.
              2,6 In
              situations where oxygen is not
              available, rescue breathing can be
              very effective in supporting
              respiration until naloxone becomes
              available.27 Rescue breathing
              involves the following steps:</p>
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Verify that the airway is clear.</span></li>
                  <li><span style="color:#000;">With one hand on the patient’s chin, tilt the head back and pinch the nose closed.</span></li>
                  <li><span style="color:#000;">Place your mouth over the patient’s mouth to make a seal and give 2 slow breaths (the patient’s chest should rise, but not the stomach).</span></li>
                  <li><span style="color:#000;">Follow up with 1 breath every 5 seconds.</span></li>
                </ul>
                <b style="color:#0a508c;">ADMINISTER NALOXONE.</b>
                Naloxone competitively binds
                opioid receptors and is the
                antagonist of choice for the
                reversal of acute opioid toxicity.
                Any patient who presents with
                signs of opioid overdose, or when
              </td>
            </tr>
          </table>

          <br>

          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>&emsp;
              <td style="width:70%;vertical-align:unset;border-right:1px solid black;">
              <p>this is suspected, should be administered naloxone.9 Naloxone
              can be given intranasally intramuscularly, subcutaneously, or by
              intravenous injection.9,17,18</p>

              <p><span style="color:#0a508c;">PREGNANT PATIENTS.</span> Naloxone can be used in life-threatening opioid overdose circumstances in pregnant women.9</p>

              <p><b style="color:#0a508c;">MONITOR THE PATIENT’S RESPONSE.</b> Patients should be
              monitored for re-emergence of signs and symptoms of opioid
              toxicity for at least 4 hours following the last dose of naloxone
              (however, patients who have overdosed on long-acting opioids
              require more prolonged monitoring).6</p>

              <p>&emsp;Most patients respond to naloxone by returning to
              spontaneous breathing, with mild withdrawal symptoms.6 The
              response generally occurs within 3 to 5 minutes of naloxone
              administration. (Continue rescue breathing while waiting for the
              naloxone to take effect.)</p>

              <p>&emsp;The duration of effect of naloxone is 20 to 90 minutes de-
              pending on dose and route of administration. Patients should be
              observed after that time for re-emergence of overdose
              symptoms. The goal of naloxone therapy should be restoration of
              adequate spontaneous breathing, but not necessarily complete
              arousal.18,19</p>

              <p>&emsp;More than one dose of naloxone may be required to revive
              the patient. Those who have taken longer-acting opioids or
              opioid partial agonists may require further doses or may require
              further intravenous bolus doses or an infusion of naloxone.22
              Therefore, it is essential to get the person to an emergency
              department or other source of acute care as quickly as possible,
              even if he or she revives after the initial dose of naloxone and
              seems to feel better.</p>

              <p><b style="color:#0a508c;">SIGNS OF OPIOID WITHDRAWAL.</b> Withdrawal triggered by
              naloxone can feel unpleasant. As a result, some persons
              become agitated or combative when this happens and need help
              to remain calm.</p>

              <p>&emsp;The signs and symptoms of opioid withdrawal in an individual
              who is physically dependent on opioids may include (but are not
              limited to) the following: body aches, diarrhea, tachycardia, fever,
              runny nose, sneezing, piloerection, sweating, yawning, nausea
              or vomiting, nervousness, restlessness or irritability, shivering or
              trembling, abdominal cramps, weakness, and increased blood
              pressure.17 Withdrawal syndromes may be precipitated by as
              little as 0.05 to 0.2 mg intravenous naloxone in a patient taking
              24 mg per day of methadone.</p>
              </td>
              <td style="width:30%;font-size:13px;padding-left:10px;padding-right:10px;vertical-align:unset;">
              <p>&emsp;In neonates, opioid withdrawal
              may also produce convulsions,
              excessive crying, and hyperactive
              reflexes.17 Additionally, in
              neonates, opiate withdrawal may
              be life- threatening if not
              recognized and properly treated.</p>

              <p><b style="color:#0a508c;">NALOXONE NON-
              RESPONDERS.</b> If a patient does
              not respond to naloxone, an
              alternative explanation for the
              clinical symptoms should be
              considered. The most likely
              explanation is that the person is not
              over- dosing on an opioid but
              rather some other substance or
              may even be experiencing a non-
              overdose medical emergency.
              Another possible explanation to
              consider is that the individual has
              overdosed on buprenorphine, a
              long-acting opioid partial agonist.
              Because buprenorphine has a
              higher affinity for the opioid
              receptors than do other opioids,
              naloxone may not be effective at
              reversing the effects of
              buprenorphine-induced opioid
              overdose5.</p>
              <p>&emsp;In all cases, support of
              ventilation, oxygenation, and blood
              pressure should be sufficient to
              prevent the complications of opioid
              overdose and should be given the
              highest priority if the patient’s
              response to naloxone is not
              prompt.</p>

              <p>NOTE: All naloxone products have
              an expiration date. It is important to
              check the expiration date and
              obtain replacement naloxone as
              needed.</p>
              </td>

            </tr>
          </table>
          <br>
          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:350px;">
            <tr>&emsp;
              <td style="width:70%;vertical-align:unset;border-right:1px solid black;">
                <b style="color:#0a508c; font-size:22px;">LEGAL AND LIABILITY CONSIDERATIONS</b>
                <p>Health care professionals who are concerned about legal risks
                associated with prescribing naloxone may be reassured by the
                fact that prescribing naloxone to manage opioid overdose is
                consistent with the drug’s FDA-approved indication, resulting in
                no increased liability so long as the prescriber adheres to
                general rules of professional conduct. Many state laws and
                regulations now permit physicians to prescribe naloxone to a
                third party, such as a caregiver.11 More information on state
                policies is available at <span style="text-decoration:underline;">http://www.prescribetoprevent.org</span> or from
                individual state medical boards.</p>
                <br>
                <b style="color:#0a508c; font-size:22px;">CLAIMS CODING AND BILLING</b>
                <p>&emsp;Most private health insurance plans, Medicare, and Medicaid
                cover naloxone for the treatment of opioid overdose, but policies
                vary by state. The cost of take-home naloxone should not be a
                prohibitive factor. Not all community pharmacies stock naloxone
                routinely, but they can always order it. If you are caring for a
                large population of patients who are likely to benefit from
                naloxone, you may wish to notify the pharmacy when you
                implement naloxone prescribing as a routine practice.</p>
                <br>
                <p>&emsp;The codes for Screening, Brief Intervention, and Referral to
                Treatment (SBIRT) can be used to bill time for counseling a
                patient about how to recognize overdose and how to administer
                naloxone. Billing codes for SBIRT are as follows:</p>

                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Commercial Insurance: CPT 99408 (15 to 30 minutes)</span></li>
                  <li><span style="color:#000;">Medicare: G0396 (15 to 30 minutes)</span></li>
                  <li><span style="color:#000;">Medicaid: H0050 (per 15 minutes)</span></li>
                </ul>
              </td>
              <td style="width:30%;font-size:13px;padding-left:10px;padding-right:10px;vertical-align:unset;">
              <p>&emsp;For counseling and instruction
              on the safe use of opioids,
              including the use of naloxone
              outside of the context of SBIRT
              services, the provider should
              document the time spent in
              medication education and use the
              E&M code that accurately captures
              the time and complexity. For
              example, for new patients deemed
              appropriate for opioid
              pharmacotherapy and when a
              substantial and appropriate amount
              of additional time is used to provide
              a separate service such as
              behavioral counseling (e.g., opioid
              overdose risk assessment and
              naloxone administration training),
              consider using modifier–25 in
              addition to the E&M code.</p>
            <br>
              <p>In addition, when using an
              evidence-based opioid use
              disorder or overdose risk factor
              assessment tool/screening
              instrument, CPT Code 99420
              (Administration and interpretation
              of health risk assessment
              instrument) can be used for
              patients with commercial
              insurance.</p>

              </td>
            </tr>
          </table>
<br>
          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>INFORMATION FOR PRESCRIBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:550px;">
            <tr>
              <td>
                <p><b style="color:#0a508c; font-size:25px;">RESOURCES FOR PRESCRIBERS</b></p>
                <br>
                <p>Additional information on prescribing opioids for chronic pain is available at the following websites: <span style="text-decoration:underline;">http://www.opioidprescribing.com</span>.</p>
                    <br>
                  <p>Sponsored by the Boston University School of Medicine, with support from SAMHSA, this site present course modules on various aspects of prescribing opioids for chronic pain. To view the list of courses and to register, go to <span style="text-decoration:underline;">http://www.opioidprescribing.com/overview</span>. CME credits are available at no charge.</p>
                    <br>
                    <p><span style="text-decoration:underline;">http://pcss-o.org</span> or www.pcssmat.org. Sponsored by the American Academy of Addiction Psychiatry in collaboration with other specialty societies and with support from SAMHSA, the Providers’ Clinical Support System offers multiple resources related to opioid prescribing and the diagnosis and management of opioid use disorder.</p>
                    <br>
                    <p><span style="text-decoration:underline;">http://www.er-la-opioidrems.com/IwgUI/rems/home.action</span>. As required by the FDA under a risk management program for extended-release and long-acting opioid analgesics, this website provides physician training and patient education on the use of such medications.</p>
                    <br>
                    <p><span style="text-decoration:underline;">http://www.medscape.com</span>. One course module sponsored by SAMHSA on Screening, Brief Intervention, and Referral to Treatment (SBIRT) can be accessed at <span style="text-decoration:underline;">http://www.medscape.org/viewarticle/830331</span>. CME/CE credits are available at no charge.</p>
                    <br>
                    <p><span style="text-decoration:underline;">http://prescribetoprevent.org</span>. Compiled by prescribers, pharmacists, public health workers, lawyers, and researchers working on overdose prevention and naloxone access, this privately funded site provides resources to help health care providers educate their patients to reduce overdose risk and provide naloxone rescue kits to patients.</p>
              </td>
            </tr>
          </table>
          <br>
          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>SAFETY ADVICE FOR PATIENTS & FAMILY MEMBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>&emsp;
              <td style="width:50%;vertical-align:unset;border-right:1px solid black;">
                <p><b style="color: #0a508c;">WHAT ARE OPIOIDS?</b></p>
                <P style="line-height: 27px;"><span style="color: #0a508c; font-size:80px; float: left; line-height: 1;">O</span><span>pioids include illicit drugs such as heroin and prescription medications used to treat pain such as morphine, codeine, methadone, oxycodone, hydrocodone, fentanyl, hydromorphone, and buprenorphine.</span>
                Opioids work by binding to specific receptors
                in the brain, spinal cord, and gastrointestinal tract.
                In doing so, they minimize the body’s perception
                of pain. However, stimulating the opioid receptors
                or “reward centers” in the brain can also trigger
                other systems of the body, such as those
                responsible for regulating mood, breathing, and
                blood pressure.</p>
                <br>
                <p>A variety of effects can occur after a person
                takes opioids, ranging from pleasure to nausea
                and vomiting, from severe allergic reactions
                (anaphylaxis) to overdose, in which breathing and
                heartbeat slow or even stop.</p>
                <br>
                <p>Opioid overdose can occur when a patient
                misunderstands the directions for use,
                accidentally takes an extra dose, or deliberately
                misuses a prescription opioid or an illicit drug
                such as heroin.</p>
                <br>
                <p>Also at risk is the person who takes opioid
                medications pre- scribed for someone else, as is
                the individual who combines opioids—prescribed
                or illicit—with alcohol, certain other medications,
                and even some over-the-counter products that
                depress breathing, heart rate, and other functions
                of the central nervous system5</p>
                <br>
                <p><b style="color: #0a508c;">PREVENTING OVERDOSE</b>
                If you are concerned about your own use of
                opioids, don’t wait! Talk with the health care
                professional(s) who prescribed the medications
                for you. If you are concerned about a family
                member or friend, urge him or her to talk to
                whoever prescribed the medication.</p>
                <br>
                <p>Effective treatment of opioid use disorder can
                reduce the risk of overdose and help a person
                who is misusing or addicted to opioid medications
                attain a healthier life. An evidence-based practice</p>

              </td>
              <td style="width:50%;padding-left:10px;padding-right:10px;vertical-align:unset;">
              <p>for treating opioid addiction is the use of United
              States Food and Drug Administration (FDA)-
              approved medications, along with counseling and
              other supportive services. These services are
              available at SAMHSA-certified and DEA-
              registered opioid treatment programs (OTPs).28,29
              In addition, physicians who are trained to provide
              treatment for opioid addiction in office-based and
              other settings with medications such as
              buprenorphine/naloxone and naltrexone may be
              available in your community.30</p>
              <br>
              <b style="color: #0a508c;">IF YOU SUSPECT AN OVERDOSE</b>
              An opioid overdose requires immediate
              medical attention. An essential first step is to get
              help from some- one with medical expertise as
              soon as possible. Call 911 immediately if you or
              someone you know exhibits any of the symptoms
              listed below. All you have to say: “Some- one is
              unresponsive and not breathing.” Give a clear
              address and/or description of your location.

              Signs of OVERDOSE, which is a life-threatening emergency, include the following:
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">The face is extremely pale and/or clammy to the touch.</span></li>
                  <li><span style="color:#000;">The body is limp.</span></li>
                  <li><span style="color:#000;">Fingernails or lips have a blue or purple cast.</span></li>
                  <li><span style="color:#000;">The person is vomiting or making gurgling noises.</span></li>
                  <li><span style="color:#000;">He or she cannot be awakened from sleep or is unable to speak.</span></li>
                  <li><span style="color:#000;">Breathing is very slow or stopped.</span></li>
                  <li><span style="color:#000;">The heartbeat is very slow or stopped.</span></li>
                </ul>
                Signs of OVERMEDICATION, which may progress to overdose, include:
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Unusual sleepiness or drowsiness.</span></li>
                  <li><span style="color:#000;">Mental confusion, slurred speech, or intoxicated behavior.</span></li>
                  <li><span style="color:#000;">Slow or shallow breathing.</span></li>
                  <li><span style="color:#000;">Extremely small “pinpoint” pupils.</span></li>
                  <li><span style="color:#000;">Slow heartbeat or low blood pressure.</span></li>
                  <li><span style="color:#000;">Difficulty in being awakened from sleep.</span></li>
                </ul>
              </td>
            </tr>
          </table>

          <br>

          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>SAFETY ADVICE FOR PATIENTS & FAMILY MEMBERS</b>
              </td>
            </tr>
          </table>
          <table style="width:100%; padding-bottom:50px;">
            <tr>
              <td style="width:33%;vertical-align:unset;border-right:1px solid black;">
                <b style="color:#0a508c;">WHAT IS NALOXONE?</b>
                  <p>Naloxone is an antidote to
                  opioid overdose. It is an opioid
                  antagonist that is used to
                  reverse the effects of opioids.
                  Naloxone works by blocking
                  opiate receptor sites. It is not
                  effective in treating overdoses of
                  benzodiazepines (such as Vali-
                  um®, Xanax®, or Klonopin®),
                  barbiturates (Seconal® or
                  Fiorinal®), clonidine, Elavil®,
                  GHB, or ketamine. It is also not
                  effective in treating overdoses of
                  stimulants such as cocaine and
                  amphetamines (including
                  methamphetamine and Ecstasy).
                  However, if opioids are taken in
                  combination with other sedatives
                  or stimulants, naloxone may be
                  helpful.</p>
                  <b style="color:#0a508c;">IMPORTANT SAFETY INFORMATION. </b>
                  <p>Naloxone may cause dizziness, drowsiness, or fainting.
                  These effects may be worse if it is taken with alcohol or certain medicines. For more information, see </p>

                  <!-- <p style="width:33%;text-decoration:underline;">http://www.fda.gov/drugs/drugsafety/postmarketdrugsafetyinformationforpatientsandproviders/ucm472923.htm.</p> -->

                  <b style="color:#0a508c;">REPORT ANY SIDE EFFECTS</b>
                   Get emergency medical help if you or someone has any signs of an allergic reaction after taking naloxone, such as hives,
              </td>
              <td style="width:33%;border-right:1px solid black;padding-left:10px;padding-right:10px;">
                difficulty breathing, or swelling of your face, lips, tongue, or throat.
                <p><span style="color:#0a508c;font-style:italic;">Call your doctor or 911 at once</span>if you have a serious side effect such as:</p>

                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Chest pain, or fast or irregular heartbeats.</span></li>
                  <li><span style="color:#000;">Dry cough, wheezing, or feeling short of breath.</span></li>
                  <li><span style="color:#000;">Sweating, severe nausea, or vomiting.</span></li>
                  <li><span style="color:#000;">Severe headache, agitation, anxiety, confusion, or ringing in your ears.</span></li>
                  <li><span style="color:#000;">Seizures (convulsions).</span></li>
                  <li><span style="color:#000;">Feeling that you might pass out.</span></li>
                  <li><span style="color:#000;">Slow heart rate, weak pulse, fainting, or slowed breathing.</span></li>
                </ul>
                If you are being treated for opioid use disorder (either an illicit drug like heroin or a medication prescribed for pain), you may experience the following symptoms of opioid withdrawal after taking naloxone:
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Feeling nervous, restless, or irritable.</span></li>
                  <li><span style="color:#000;">Body aches.</span></li>
                  <li><span style="color:#000;">Dizziness or weakness.</span></li>
                  <li><span style="color:#000;">Diarrhea, stomach pain, or mild nausea.</span></li>
                  <li><span style="color:#000;">Fever, chills, or goosebumps.</span></li>
                  <li><span style="color:#000;">Sneezing or runny nose in the absence of a cold.</span></li>
                </ul>
                This is not a complete list of side effects, and others may occur. Talk to your doctor about side effects and how to deal with them.
              </td>
              <td style="width:33%;vertical-align:unset;padding-left:10px;padding-right:10px;">
                  <b style="color:#0a508c;">STORE NALOXONE IN A SAFE PLACE</b>
                  Naloxone is usually handled and stored by a health care provider.
                  If you are using naloxone at home, store it in a locked cabinet or other space
                  hat is out of the reach of children or pets.

                  <b style="color:#0a508c;">SUMMARY: HOW TO AVOID OPIOID OVERDOSE</b>
                  <ul style="list-style-type: number; color:#0a508c;">
                    <li><span style="color:#000;">Take medicine only if it has been prescribed to you by your doctor.</span></li>
                    <li><span style="color:#000;">Do not take more medicine or take it more often than instructed.</span></li>
                    <li><span style="color:#000;">Call a doctor if your pain gets worse.</span></li>
                    <li><span style="color:#000;">Never mix pain medicines with alcohol, sleeping pills, or any illicit substance.</span></li>
                    <li><span style="color:#000;">Store your medicine in a safe place where children or pets can- not reach it.</span></li>
                    <li><span style="color:#000;">Learn the signs of overdose and how to use naloxone to keep it from becoming fatal.</span></li>
                    <li><span style="color:#000;">Teach your family and friends how to respond to an overdose.</span></li>
                    <li><span style="color:#000;">Dispose of unused medication properly.</span></li>
                  </ul>
                  <!-- <b style="color:#0a508c;">READ MORE AT</b> -->
                  <!-- <p style="text-decoration:underline;">http://www.fda.gov/drugs/drugsafety/postmarketdrugsafetyinformationforpatientsandproviders/ucm472923.htm.</p> -->
              </td>
            </tr>
          </table>

          <br>

          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>RECOVERING FROM OPIOID OVERDOSE</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>
              <td style="width:70%;vertical-align:unset;border-right:1px solid black;">
                  <b style="color:#0a508c;font-size:25px;">RESOURCES FOR OVERDOSE SURVIVORS AND FAMILY MEMBERS</b>
                  <P style="line-height: 27px;"><span style="color: #0a508c; font-size:60px; float: left; line-height: 1;">S</span><span>urvivors of opioid overdose have experienced a life- changing and traumatic event. They have had to deal with the emotional consequences of overdosing, which can involve embarrassment, guilt, anger, and gratitude, all accompanied by the discomfort of opioid withdrawal. Most need the support of family and friends to take the next steps toward recovery.</span></p>
                  <br>
                  <p>&emsp;While many factors can contribute to opioid overdose, it is al-most always an accident. Moreover, the underlying problem that led  to opioid use—most often pain or substance use disorder—still exists and continues to require attention.2</p>
                  <br>
                  <p>&emsp;Moreover, the individual who has experienced an overdose is not the only one who has endured a traumatic event. Family members often feel judged or inadequate because they could not prevent the overdose. It is important for family members to work together to help the overdose survivor obtain the help that he or she needs.</p>
                  <br>
                  <b style="color:#0a508c;font-size:25px;">FINDING A NETWORK OF SUPPORT</b>
                  <p>&emsp;As with any disease, it is not a sign of weakness to admit that a
                  person or a family cannot deal with the trauma of overdose with- out
                  help. It takes real courage to reach out to others for support and to
                  connect with members of the community to get help.</p>
                  <br>
                  <p>&emsp; Health care providers, including those who specialize in treating
                  substance use disorders, can provide structured, therapeutic support
                  and feedback.</p>
                  <br>
                  <p>&emsp;If the survivor’s underlying problem is pain, referral to a pain
                  specialist may be in order. If it is addiction, the patient should be
                  referred to an addiction specialist for assessment and treatment,
                  either by a physician specializing in the treatment of opioid addiction,
                  in a residential treatment program, or in a federally certified Opioid
                  Treatment Program (OTP). In each case, counseling can help the
                  individual manage his or her problems in a healthier way. Choosing
                  the path to recovery can be a dynamic and challenging process, but
                  there are ways to help.</p>
              </td>
              <td style="width:30%;padding-left:10px;padding-right:10px;vertical-align:unset;">
              <p>In addition to receiving support
                from family and friends,
                overdose survivors can access
                a variety of community-based
                organizations and institutions,
                such as:</p>
                <br>
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">Health care and behavioral health providers.</span></li>
                  <li><span style="color:#000;">Peer-to-peer recovery support groups such as Narcotics Anonymous.</span></li>
                  <li><span style="color:#000;">Faith-based organizations.</span></li>
                  <li><span style="color:#000;">Educational institutions.</span></li>
                  <li><span style="color:#000;">Neighborhood groups.</span></li>
                  <li><span style="color:#000;">Government agencies.</span></li>
                  <li><span style="color:#000;">Family and community support programs.</span></li>
                </ul>
              </td>
            </tr>
          </table>
        <br>
          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>RECOVERING FROM OPIOID OVERDOSE</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:450px;">
            <tr>&emsp;
              <td>
                <b style="color:#0a508c;font-size:30px;">RESOURCES</b>
                <p>Information on opioid overdose and helpful advice for overdose survivors and their families can be found at:</p>
                <b style="color:#0a508c;">Substance Abuse and Mental Health Services Administration (SAMHSA)</b>
                <ul style="list-style-type: square; color:#0a508c;">
                  <li><span style="color:#000;">National Helpline 1-800-662-HELP (4357) or 1-800-487-4889 (TDD—for hearing impaired)</span></li>
                  <li><span style="color:#000;">Behavioral Health Treatment Services Locator: <a style="text-decoration:underline;">https://findtreatment.samhsa.gov</a> to search by address, city, or zip code</span></li>
                  <li><span style="color:#000;">Buprenorphine Treatment Physician Locator: <a style="text-decoration:underline;">http://www.samhsa.gov/medication-assisted-treatment/physician-program-data/treatment-physician-locator</a></span></li>
                  <li><span style="color:#000;">State Substance Abuse Agencies: <a style="text-decoration:underline;">https://findtreatment.samhsa.gov/TreatmentLocator/faces/about.jspx</a></span></li>
                </ul>
                <b style="color:#0a508c;">Centers for Disease Control and Prevention (CDC):</b>
                <p style="text-decoration:underline;">http://www.cdc.gov/drugoverdose/epidemic</p>
                <br>
                <b style="color:#0a508c;">National Institutes of Health (NIH), National Center for Biotechnical Information:</b>
                <p style="text-decoration:underline;">http://www.ncbi.nlm.nih.gov</p>
                <br>
                <b style="color:#0a508c;">Partnership for Drug-Free Kids:</b>
                <p style="text-decoration:underline;">http://www.drugfree.org/join-together/opioid-overdose-antidote-being-more-widely-distributed-to-those-who-use-drugs</p>
                <br>
                <b style="color:#0a508c;">Project Lazarus:</b>
                <p style="text-decoration:underline;">http://www.projectlazarus.org</p>
                <br>
                <b style="color:#0a508c;">Harm Reduction Coalition:</b>
                <p style="text-decoration:underline;">http://www.harmreduction.org</p>
                <br>
                <b style="color:#0a508c;">Overdose Prevention Alliance:</b>
                <p style="text-decoration:underline;">http://www.overdosepreventionalliance.org</p>
                <br>
                <b style="color:#0a508c;">Toward the Heart:</b>
                <p style="text-decoration:underline;">http://www.towardtheheart.com/naloxne</p>

              </td>
            </tr>
          </table>

          <br>


          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>REFERENCES</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>&emsp;
              <td>
                <p>1 Number and age-adjusted rates of drug-poisoning deaths involving opioid analgesics and heroin: UnitedStates, 2000–2014. Centers for Disease Control and Prevention Website.<a style="text-decoration:underline;">http://www.cdc.gov/nchs/data/health_policy/AADR_drug_poisoning_involving_OA_Heroin_US_2000-2014.pdf.</a> Accessed January 11, 2016.</p>
                    <br>
                <p>2 Beletsky LB, Rich JD, Walley AY. Prevention of fatal opioid overdose. JAMA. 2012;308(18):1863-1864.</p>
                <br>
                <p>3 Centers for Disease Control and Prevention. CDC Vital Signs: Opioid painkiller prescribing—where you live makes a difference. <a style="text-decoration:underline;">http://www.cdc.gov/vitalsigns/opioid-prescribing</a>. Published July 1, 2014. Accessed January 11, 2016.</p>
                    <br>
                <p>4 Harvard Medical School. Painkillers fuel growth in drug addiction: opioid overdoses now kill more people than cocaine or heroin. Harvard Ment Hlth Let. 2011;27(7):4-5.</p>
                <br>
                <p>5 Brunton L, Chabner B, Knollman B. Goodman and Gilman’s The Pharmacological Basis of Therapeutics. 12th ed. New York: McGraw-Hill; 2011.</p>
                <br>
                <p>6 Boyer EW. Management of opioid analgesic overdose. N Engl J Med. 2012;367(2):146-155.</p>
                <br>
                <p>7 Enteen L, Bauer J, McLean R, Wheeler E, Huriaux E, Kral AH, Bamberger JD. Overdose prevention and naloxone prescription for opioid users in San Francisco. J Urban Health. 2010;87(6):931-941.</p>
                <br>
                <p>8 Seal KH, Thawley R, Gee L, et al. Naloxone distribution and cardiopulmonary resuscitation training for injection drug users to prevent heroin overdose death: a pilot intervention study. J Urban Health. 2005;82(2):303-311.</p>
                <br>
                <p>9 Bazazi AR, Zaller ND, Fu JJ, Rich JD. Preventing opiate overdose deaths: examining objections to take-home naloxone. J Health Care Poor Underserved. 2010;21(4):108–1113. doi:10.1353/hpu.2010.0935</p>
                <br>
                <p>10 Coffin PO, Sullivan SD. Cost effectiveness of distributing naloxone to heroin users for lay overdose reversal. Ann Intl Med. 2013;158(1):1-9.</p>
                <br>
                <p>11 Davis C. Legal interventions to reduce overdose mortality: naloxone access and overdose Good Samaritan laws. <a style="text-decoration:underline;">https://www.networkforphl.org/_asset/qz5pvn/network-naloxone-10-4.pdf</a>. Updated September 2015. Accessed January 11, 2016.</p>
                <br>
                <p>12 Strang J, Manning V, Mayet S, et al. Overdose training and take-home naloxone for opiate users: prospective cohort study of impact on knowledge and attitudes and subsequent management of overdoses. Addiction. 2008;103(10):1648-1657.</p>
                <br>
                <p>13 Green TC, Heimer R, Grau LE. Distinguishing signs of opioid overdose and indication for naloxone: an evaluation of six overdose training and naloxone distribution programs in the United States. Addiction.2008;103(6):979-998.</p>
                <br>
                <p>14 Centers for Disease Control and Prevention. Increases in drug and opioid overdose deaths — United States, 2000-2014. MMWR Morb Mortal Wkly Rep. 2016;64(50):1378-1382.</p>
                <br>
                <p>15 Yaksh TL, Wallace MS. Opioids, analgesia, and pain management. In: Brunton L, Chabner B, Knollman B,eds. Goodman and Gilman’s The Pharmacologic Basis of Therapeutics. 12th ed. New York, NY: McGraw-Hill; 2011, 481-526.</p>
              </td>
            </tr>
          </table>

          <table style="width:100%; color: #fff; background-color: #0a508c;">
            <tr>
              <td style="width:100%; padding-left: 30px; padding-top: 40px; padding-bottom: 40px; font-size:22px;">
                <b>REFERENCES</b>
              </td>
            </tr>
          </table>
          <table style="width:100%;padding-bottom:250px;">
            <tr>&emsp;
              <td>
                <p>16 Centers for Disease Control and Prevention. Community-based opioid overdose prevention programs providing naloxone—United States, 2010. MMWR Morb Mortal Wkly Rep. 2012;261(6):101-105.</p>
                <br>
                <p>17 Rx List. <a style="text-decoration:underline;" href="http://www.rxlist.com" target="_blank">http://www.rxlist.com</a>. Accessed March 24, 2013.</p>
                <br>
                <p>18 Drugs.com. <a style="text-decoration:underline;" target="_blank">http://www.drugs.com</a>. Accessed March 24, 2013.</p>
                <br>
                <p>19 FDA moves quickly to approve easy-to-use nasal spray to treat opioid overdose. Food and Drug Administration
                Website:.<a style="text-decoration:underline;" href="http://www.fda.gov/NewsEvents/Newsroom/PressAnnouncements/ucm473505.htm" target="_blank">http://www.fda.gov/NewsEvents/Newsroom/PressAnnouncements/ucm473505.htm</a>.
                Published November 18, 2015. Updated November 19, 2016. Accessed January 11, 2016.</p>
                <br>
                <p>20 Sporer KA. Acute heroin overdose. Ann Intern Med. 1999;130(7):584-590.</p>
                <br>
                <p>21 LoVecchio F, Pizone A, Riley B, Sami, A, D’Incognito C. Onset of symptoms after methadone overdose. Am J Emerg Med. 2007;25(1):57-59.</p>
                <br>
                <p>22 Isaacson JH, Hopper JA, Alford DP, Parran T. Prescription drug use and abuse. Risk factors, red flags, and prevention strategies. Postgrad Med. 2005;118:19.</p>
                <br>
                <p>23 Kampman, K, Jarvis M. American Society of Addiction Medicine (ASAM) National Practice Guideline for the use of medications in the treatment of addiction involving opioid use. J Addict Med. 2015;9(5):358-67. doi:10.1097/ADM.0000000000000166</p>
                <br>
                <p>24 Centers for Disease Control and Prevention. CDC grand rounds: prescription drug overdoses—a U.S. epidemic. MMWR Morb Mortal Wkly Rep. 2012;61(1):10-13.</p>
                <br>
                <p>25 Finch JW, Parran TV Jr, Wilford BB, Wyatt SA. Clinical, ethical, and legal considerations in prescribing drugs with abuse potential. In: Ries RK, Fiellin DA, Miller SC, Saitz R, eds. Principles of Addiction Medicine. 5th ed. Philadelphia, PA: Wolters Kluwer; 2014:1703-1710.</p>
                <br>
                <p>26 Clary PL, Lawson P. Pharmacologic pearls for end-of-life care. Am Fam Physician. 2009;79(12):1059-1065.</p>
                <br>
                <p>27 Lavonas J, Drennan IR, Gabrielli A, Heffner AC, Hoyte CO, Orkin AM, Sawyer KN, Donnino MW. Part 10:Special circumstances of resuscitation. In: American Heart Association Guidelines Update for Cardiopulmonary Resuscitation and Emergency Cardiovascular Care. Dallas, TX: American Heart Association; 2015.</p>
                <br>
                <p>28 Michna E, Ross EL, Hynes WL, et al. Predicting aberrant drug behavior in patients treated for chronic pain: importance of abuse history. J Pain Symptom Manage. 2004;28(3):250-258.</p>
                <br>
                <p>29 SAMHSA’s National Helpline 1-800-662-HELP (4357) or 1-800-487-4889 (TDD for hearing impaired).</p>
                <br>
                <p>30 Behavioral Health Treatment Services Locator: <a style="text-decoration:underline;" target="_blank">https://findtreatment.samhsa.gov</a> to search by address, city, or zip code.</p>
              </td>
            </tr>
          </table>
        ';

    //  echo $print;
    //  exit;
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($print);
$file='pdf/'.time().'.pdf';
$mpdf->Output($file,'I');

?>
