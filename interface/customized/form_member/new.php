<?php

/**
 * Clinical instructions form.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2017-2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
if ($formid) {
    $sql = "SELECT * FROM `form_member` WHERE id=? AND pid = ? AND encounter = ?";
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
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
</head>
<body style="padding:100px;">
<form method="post" id="my_pat_form" name="my_form" action="<?php echo $rootdir; ?>/forms/form_member/save.php?id=<?php echo attr_url($formid); ?>">

    <h2>Designation of Representative /Authorization Form    </h2>
    <p>This form is to be filled out by a member if there is a request to release the member’s health information to another person or company or a request to appoint an Authorized Representative. Please include as much information as you can.
    </p>
    <h3 style="color:white;background-color: black;">PART A:MEMBER INFORMATION</h3>
    <table style="margin-top: 8px;width:100%"> 
        <tr>
        <td style="width:25%;border:2px solid black;"> 
        <label style="font-size: 14px;"> Member last Name: </label><br>
        <input style="border: none;" type="text" value="<?php echo text($check_res['lname']);?>" name="lname">
        </td>
        <td style="width:25%;border:2px solid black;"> 
        <label style="font-size: 14px;"> Member first Name:</label><br>
        <input style="border: none;" type="text" value="<?php echo text($check_res['fname']);?>" name="fname">

        </td>
            <td style="width:25%;border:2px solid black;"> 
            <label style="font-size: 14px;">Middle initial:</label><br>
            <input style="border: none;" type="text" value="<?php echo text($check_res['minitial']);?>" name="minitial">

            </td>
                <td style="width:25%;border:2px solid black;"> 
                <label style="font-size: 14px;"> Member Date Of Birth:</label><br>
                <input style="border: none;" type="date" value="<?php echo text($check_res['dob']);?>" name="dob">

                </td>
                </tr>
                <tr>
                    <td style="width:25%;border:2px solid black;"> 
                    <label style="font-size: 14px;">Member street address: </label><br>
                    <input style="border: none;" type="text" value="<?php echo text($check_res['address']);?>" name="address">

                    </td>
                    <td style="width:25%;border:2px solid black;"> 
                    <label style="font-size: 14px;">City:</label><br>
                    <input style="border: none;" type="text" value="<?php echo text($check_res['city']);?>" name="city">

                    </td>
                        <td style="width:25%;border:2px solid black;"> 
                        <label style="font-size: 14px;">State:</label><br>
                        <input style="border: none;" type="text" value="<?php echo text($check_res['state']);?>" name="state">

                        </td>
                            <td style="width:25%;border:2px solid black;"> 
                            <label style="font-size: 14px;">Zipcode:</label><br>
                            <input style="border: none;" type="number" value="<?php echo text($check_res['zipcode']);?>" name="zipcode">

                            </td>
                          </tr>
            <tr>
              <td style="width:25%;border:2px solid black;"> 
                  <label style="font-size: 14px;">Daytime phone number(with area code)    </label><br>
                  <input style="border: none;" type="number" value="<?php echo text($check_res['pnumber']);?>" name="pnumber">

                     </td>
                     <td style="width:25%;border:2px solid black;"> 
                     <label style="font-size: 14px;">ldentificaton number(see identification card):</label><br>
                     <input style="border: none;" type="number" value="<?php echo text($check_res['inumber']);?>" name="inumber">

                         </td>
                    <td colspan="2" style="width:50%;border:2px solid black;"> 
                   <label style="font-size: 14px;">Group number(see identification card):</label><br>
                   <input style="border: none;" type="number" value="<?php echo text($check_res['gnumber']);?>" name="gnumber">

                  </td>
                        </tr>
                                    
        </table>
        <h3 style="color:white;background-color: black;">PART B:PERSON OR COMPANY WHO CAN RECEIVE MY INFORMATION</h3>
        <p>The following people or companies have the right to receive my information. they must be 18 year of age or older.
        </p>
        <p>Please check each box that applies and enter first and lastname.
        </p>
        <table style="margin-top: 8px;width:100%"> 
            <tr>
            <td style="width:50%;border:2px solid black;"> 
            <input type="checkbox" name="checkbox1"   value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked";}?>>My Spouse(enter first and lastname) <br>
                    <input style="width:50%" type="text" value="<?php echo text($check_res['cinput1']);?>" name="cinput1">
            </td>
            <td style="width:50%;border:2px solid black;"> 
                <input type="checkbox" name="checkbox2"   value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked";}?>>My domestic partner(enter first and lastname)
                <br>
                <input style="width:50%" type="text" value="<?php echo text($check_res['cinput2']);?>" name="cinput2">
    
            </td>
                    </tr>
                    <tr>
                        <td style="width:50%;border:2px solid black;"> 
                            <input type="checkbox" name="checkbox3"   value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked";}?>>My adult children (enter first and last name[s])<br>
                                <input style="width:50%" type="text" value="<?php echo text($check_res['cinput3']);?>" name="cinput3">
                        </td>
                        <td style="width:50%;border:2px solid black;"> 
                            <input type="checkbox" name="checkbox4"   value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked";}?>>Myinsurance broker or agent(enter the name of the company and first and lastname, if you have it)

                            <br>
                            <input style="width:50%" type="text" value="<?php echo text($check_res['cinput4']);?>" name="cinput4">
                        </td>
                              </tr>
                <tr>
                    <td style="width:50%;border:2px solid black;"> 
                        <input type="checkbox" vame="checkbox4_1"   value="1" <?php if ($check_res['checkbox4_1'] == "1") {
            echo "checked";}?>>My parents (if you are over 18 -enter first and last name[s])<br>
                            <input style="width:50%" type="text" value="<?php echo text($check_res['cinput4_1']);?>" name="cinput4_1">
                    </td>
                    <td style="width:50%;border:2px solid black;"> 
                        <input type="checkbox" name="checkbox5"   value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked";}?>>0ther(enter first and last name {if you have it} name of company, and how it’s related to you)


                        <br>
                        <input style="width:50%" type="text" value="<?php echo text($check_res['cinput5']);?>" name="cinput5">
                    </td>
                            </tr>
                                        
            </table>
            <h3 style="color:white;background-color: black;">PART C:INFORMATION THAT CAN BE RELEASED</h3>
            <P>I allow the following information to be used or released by Anthem Blue Cross on my behalf(check only one box):
            </P>
            <input type="checkbox" name="checkbox6"   value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked";}?>>All my information. This  can  include  health, a diagnosis(name of illness or condition), claims, doctors and other health care
            producers  and  financial information(like billing and banking).this doesn’t include sensitive  information
            (see below) unless it is apporved below.
            <p>OR</p>
            <input type="checkbox" name="checkbox7"   value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked";}?>>Only limited informafion may be released (check if all boxes below (that apply to you).<br>

            <table style="margin-top: 8px;width:100%"> 
<tr>
<td style="width:10%;"> 
<input type="checkbox" name="checkbox8"   value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked";}?>>Appeal
</td>
<td style="width:10%;"> 
<input type="checkbox" name="checkbox9"   value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked";}?>>Eligibility and enrollment
</td>
<td style="width:10%;"> 
<input type="checkbox" name="checkbox10"   value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked";}?>>Referral
</td>

</tr> 
<tr>
<td style="width:10%;"> 
<input type="checkbox" name="checkbox11"   value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked";}?>>Benefits and Coverage
</td>
<td style="width:10%;"> 
    <input type="checkbox" name="checkbox12"   value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked";}?>>Financial
    </td>
    <td style="width:10%;"> 
        <input type="checkbox" name="checkbox13"   value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked";}?>>Treatment
        </td>

    </tr>  <tr>
    <td style="width:10%;"> 
        <input type="checkbox" name="checkbox14"   value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked";}?>>billing
        </td>
        <td style="width:10%;"> 
            <input type="checkbox" name="checkbox15"   value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked";}?>>Medical records
            </td>
            <td style="width:10%;"> 
                <input type="checkbox" name="checkbox16"   value="1" <?php if ($check_res['checkbox16'] == "1") {
            echo "checked";}?>>Dental
                </td>

            </tr>  <tr>
            <td style="width:10%;"> 
                <input type="checkbox" name="checkbox17"   value="1" <?php if ($check_res['checkbox17'] == "1") {
            echo "checked";}?>>Appeal
                </td>
                <td style="width:10%;"> 
                    <input type="checkbox" name="checkbox18"   value="1" <?php if ($check_res['checkbox18'] == "1") {
            echo "checked";}?>>Eligibility and enrollment
                    </td>
                    <td style="width:10%;"> 
                        <input type="checkbox" name="checkbox19"   value="1" <?php if ($check_res['checkbox19'] == "1") {
            echo "checked";}?>>Referral
                        </td>

                    </tr>  <tr>
                    <td style="width:10%;"> 
                        <input type="checkbox" name="checkbox20"   value="1" <?php if ($check_res['checkbox20'] == "1") {
            echo "checked";}?>>claims and payment
                        </td>
                        <td style="width:10%;"> 
                            <input type="checkbox" name="checkbox21"   value="1" <?php if ($check_res['checkbox21'] == "1") {
            echo "checked";}?>>doctor and hospital
                            </td>
                            <td style="width:10%;"> 
                                <input type="checkbox" name="checkbox22"   value="1" <?php if ($check_res['checkbox22'] == "1") {
            echo "checked";}?>>vision
                                </td>
    
                            </tr> 
            <tr>
                <td style="width:10%;"> 
                    <input type="checkbox" name="checkbox26"   value="1" <?php if ($check_res['checkbox26'] == "1") {
            echo "checked";}?>>Diagnosis(name of illness or condition) and procedure Treatment
                    </td>
                    <td style="width:10%;"> 
                        <input type="checkbox" name="checkbox27"   value="1" <?php if ($check_res['checkbox27'] == "1") {
            echo "checked";}?>>pre certification and pre authorization(for treatment)
                        </td>
                        <td style="width:10%;"> 
                            <input type="checkbox" name="checkbox28"   value="1" <?php if ($check_res['checkbox28'] == "1") {
            echo "checked";}?>>Pharmacy
                            </td>

                        </tr> 
                        <tr>
                            <td style="width:10%;"> 
                                <tr>
                                    <td style="width:10%;"> 
                                        <input type="checkbox" name="checkbox29"   value="1" <?php if ($check_res['checkbox29'] == "1") {
            echo "checked";}?>>Other:
                                        <input style="width:50%" type="text" value="<?php echo text($check_res['cinput6']);?>" name="cinput6">
                                    </td>
            
                                    </tr> 
</table>
<hr/>
<p>I also approve the release of the foIlowing  types of  sensitive  information by Anthem Blue Cross(check all  boxes  that  apply to you): </p>

<input type="checkbox" name="checkbox30"   value="1" <?php if ($check_res['checkbox30'] == "1") {
            echo "checked";}?>><b>All sensitive informafion;OR</b><br>
<input type="checkbox" name="checkbox31"   value="1" <?php if ($check_res['checkbox31'] == "1") {
            echo "checked";}?>><b>Just informafion about topics checked</b><br>
<table> 
    <tr>
        <td style="width:10%;"> 
            <input type="checkbox" name="checkbox32"   value="1" <?php if ($check_res['checkbox32'] == "1") {
            echo "checked";}?>>Abortion:
        </td>
        <td style="width:10%;"> 
            <input type="checkbox" name="checkbox33"   value="1" <?php if ($check_res['checkbox33'] == "1") {
            echo "checked";}?>>Genetic testing:
        </td>
        <td style="width:10%;"> 
            <input type="checkbox" name="checkbox34"   value="1" <?php if ($check_res['checkbox34'] == "1") {
            echo "checked";}?>>Mental health:
        </td>

        </tr> 
        <tr>
            <td style="width:10%;"> 
                <input type="checkbox" name="checkbox35"   value="1" <?php if ($check_res['checkbox35'] == "1") {
            echo "checked";}?>>Abuse(physically/mental/sexual):
            </td>
            <td style="width:10%;"> 
                <input type="checkbox" name="checkbox36"   value="1" <?php if ($check_res['checkbox36'] == "1") {
            echo "checked";}?>>HIV or AIDS:
            </td>
            <td style="width:10%;"> 
                <input type="checkbox" name="checkbox37"   value="1" <?php if ($check_res['checkbox37'] == "1") {
            echo "checked";}?>>Sexually transmitted illness :
            </td>
    
            </tr> 
            <tr>
                <td style="width:10%;"> 
                    <input type="checkbox" name="checkbox38"   value="1" <?php if ($check_res['checkbox38'] == "1") {
            echo "checked";}?>>Alcohol/substance abuse:
                </td>
                <td style="width:10%;"> 
                    <input type="checkbox" name="checkbox39"   value="1" <?php if ($check_res['checkbox39'] == "1") {
            echo "checked";}?>>Maternity:
                </td>
                <td style="width:10%;"> 
                    <input type="checkbox" name="checkbox40"   value="1" <?php if ($check_res['checkbox40'] == "1") {
            echo "checked";}?>>other:   <input style="width:50%" type="text" value="<?php echo text($check_res['cinput7']);?>" name="cinput7">

                </td>
        
                </tr> 
</table>
<hr>
<p>Anthem Blue Cross is the trade name of Blue Cross of California. Anthem Blue Cross and Anthem Blue Cross Life and  Health Insurance Company are independent : licensees of the Blue Cross Association. @ anthem is a registered trademark  of anthem
    Insurance Companies, Inc. The Blue Cross name and symbol are registered marks of the Blue Cross Association. Utilization review may be provided by Anthem UM Services, Inc., a separate company.
    </p>
    <h3 style="color:white;background-color: black;">PART D:PERSON OR COMPANY THAT CAN BE ACT AS AUTHORIZED REPRESENTATIVE</h3>
    <p>The  following  person or company has the right to act as my Authorized Representative. An Authorized Representative is a person who you appoint to be your representative in carrying out a grievance or appeal, including any external review rights  that  may  be available to you. They must be 18 years of age or older. Please also complete Part B and C above to authorize the release of you information to your Authorized Representative.</p>
    <table style="margin-top: 8px;width:100%"> 
        <tr>
        <td style="width:50%;border:2px solid black;"> 
            <input type="checkbox" name="checkbox41"   value="1" <?php if ($check_res['checkbox41'] == "1") {
            echo "checked";}?>>My spouse(enter first and lastname)<br>
                <input style="width:50%" type="text" value="<?php echo text($check_res['cinput8']);?>" name="cinput8">
        </td>
        <td style="width:50%;border:2px solid black;"> 
            <input type="checkbox" name="checkbox42"   value="1" <?php if ($check_res['checkbox42'] == "1") {
            echo "checked";}?>>My domestic partner(enter first and lastname)
            <br>
            <input style="width:50%" type="text" value="<?php echo text($check_res['cinput9']);?>" name="cinput9">

        </td>
                </tr>
                <tr>
                    <td style="width:50%;border:2px solid black;"> 
                        <input type="checkbox" name="checkbox43"   value="1" <?php if ($check_res['checkbox43'] == "1") {
            echo "checked";}?>>My adult children (enter first and last name[s])<br>
                            <input style="width:50%" type="text" value="<?php echo text($check_res['cinput10']);?>" name="cinput10">
                    </td>
                    <td style="width:50%;border:2px solid black;"> 
                        <input type="checkbox" name="checkbox44"   value="1" <?php if ($check_res['checkbox44'] == "1") {
            echo "checked";}?>>Myinsurance broker or agent(enter the name of the company and first and lastname, if you have it)

                        <br>
                        <input style="width:50%" type="text" value="<?php echo text($check_res['cinput11']);?>" name="cinput11">
                    </td>
                          </tr>
            <tr>
                <td style="width:50%;border:2px solid black;"> 
                    <input type="checkbox" name="checkbox45"   value="1" <?php if ($check_res['checkbox45'] == "1") {
            echo "checked";}?>>My parents (if you are over 18 -enter first and last name[s])<br>
                        <input style="width:50%" type="text" value="<?php echo text($check_res['cinput12']);?>" name="cinput12">
                </td>
                <td style="width:50%;border:2px solid black;"> 
                    <input type="checkbox" name="checkbox46"   value="1" <?php if ($check_res['checkbox46'] == "1") {
            echo "checked";}?>>0ther(enter first and last name {if you have it} name of company, and how it’s related to you)


                    <br>
                    <input style="width:50%" type="text" value="<?php echo text($check_res['cinput13']);?>" name="cinput13">
                </td>
                        </tr>
                                    
        </table>
        <h3 style="color:white;background-color: black;">PART E:DATE YOUR APPROVAL EXPIRES</h3>
        <p>If this document was not already withdrawn, this approval will end:</p>
        <input type="checkbox" name="checkbox47"   value="1" <?php if ($check_res['checkbox47'] == "1") {
            echo "checked";}?>>At the conclusion of the appeals process<br>
        <input type="checkbox" name="checkbox48"   value="1" <?php if ($check_res['checkbox48'] == "1") {
            echo "checked";}?>>One year from the signature in part G<br>
        <input type="checkbox" name="checkbox49"   value="1" <?php if ($check_res['checkbox49'] == "1") {
            echo "checked";}?>>Upon the date or event or condition described below(please provide details)<br>

        <h3 style="color:white;background-color: black;">PART F:PURPOSE OF THIS APPROVAL</h3>
        <input type="checkbox" name="checkbox50"   value="1" <?php if ($check_res['checkbox50'] == "1") {
            echo "checked";}?>>To allow an individual to act as my Authorized Repesentative in carrying out a grievance or appeal, including any external review right that may be available to me. <br>

        <input type="checkbox" name="checkbox51"   value="1" <?php if ($check_res['checkbox51'] == "1") {
            echo "checked";}?>>To disclose informaton at my request. <br>

        <h3 style="color:white;background-color: black;">PART G:REVIEW AND APPROVAL</h3>
        <div contentEditable="true" class="text_edit"><?php 
         echo $check_res['text1']??'
        <P>I have read the contents of this form. I understand, agree, and allow  Anthem Blue Cross to  the use and release of my information as I have stated above. I also understand that signing this form is  of my own free will. I understand the  /Anthem Blue Cross does not require that I sign this form  inorder for me to  receive treatment or payment, or far enrollment or being eligible for benefits.
        <br><br> I have the right to withdraw this approval at any time by giving written notice of my withdrawal to Anthem Blue Cross. I understand that my withdrawing this approval do  not affect any action  taken  before I do so. I also understand that information that released may be given out by the person or group who receives it. If this happens, it may no longer be protected under the HIPAA Privacy Rule. I am entitled to a copy of this form</P>';?>
        </div><input type="hidden" name="text1" id="text1">
<table style="width: 100%;">
    <tr>
    <td style="width:75%;border:2px solid black;"> 
        <label style="font-size: 14px;">Member signature or Designated Legal Representative/Guardian signature </label><br>
        <input style="border: none;" type="text" value="<?php echo text($check_res['signature']);?>" name="signature">

           </td>
           <td style="width:25%;border:2px solid black;"> 
           <label style="font-size: 14px;">date:</label><br>
           <input style="border: none;" type="date" value="<?php echo text($check_res['date']);?>" name="date">

               </td>
            </tr>
</table>
<table style="width: 100%; border:1px solid black">
    <tr>
        <td>
            <h3  style="color:white;background-color: black;">DESIGNATED LEGAL REPRESENTATIVE GUARDIAN</h3>
    <p>If this form is signed other then by member or parent such as legal representative,personal Representative or guardian on behalf of the member.please submit the below:</p>
    <ul>
        <li>A Copy of the healthcare,general or Durable power of attorney OR</li>
        <li>A court order or other documentation that shows custody or other legal documentaion showing the authority of the legal to act as a Representative to act on the members  behalf</li>

        <p>Please Complete the following</p>
    </ul>

        </td>
    </tr>
    
</table>

<table style="margin-top: 8px;width:100%"> 
    <tr>
    <td style="width:50%;border:2px solid black;"> 
    <label style="font-size: 14px;"> legal representative (print full Name) :</label><br>
    <input style="border: none;" type="text" value="<?php echo text($check_res['lename']);?>" name="lename">

    </td>
        <td  colspan="3"style="width:50%;border:2px solid black;"> 
        <label style="font-size: 14px;">legal relationship to member:</label><br>
        <input style="border: none;" type="text" value="<?php echo text($check_res['lrelation']);?>" name="lrelation">
            </tr>
            <tr>
                <td style="width:25%;border:2px solid black;"> 
                <label style="font-size: 14px;">legal representative street address: </label><br>
                <input style="border: none;" type="text" value="<?php echo text($check_res['laddress']);?>" name="laddress">

                </td>
                <td style="width:25%;border:2px solid black;"> 
                <label style="font-size: 14px;">City:</label><br>
                <input style="border: none;" type="text" value="<?php echo text($check_res['lcity']);?>" name="lcity">

                </td>
                    <td style="width:25%;border:2px solid black;"> 
                    <label style="font-size: 14px;">State:</label><br>
                    <input style="border: none;" type="text" value="<?php echo text($check_res['lstate']);?>" name="lstate">

                    </td>
                        <td style="width:25%;border:2px solid black;"> 
                        <label style="font-size: 14px;">Zipcode:</label><br>
                        <input style="border: none;" type="text" value="<?php echo text($check_res['lzipcode']);?>" name="lzipcode">

                        </td>
                      </tr>
        <tr>
          <td style="width:75%;border:2px solid black;"> 
              <label style="font-size: 14px;">Signature   </label><br>
              <input style="border: none;" type="number" value="<?php echo text($check_res['signature2']);?>" name="signature2">

                 </td>
                 <td  colspan="3" style="width:25%;border:2px solid black;"> 
                 <label style="font-size: 14px;">Date:</label><br>
                 <input style="border: none;" type="date" value="<?php echo text($check_res['date2']);?>" name="date2">

                     </td>
                    </tr>
                                
    </table><br>
    <p>Please return the completed form to<br>Grievances and Appeals <br> P.O Box 4310 <br>Woodland Hills,CA 91365</p>
    <b>Be sure to keep a copy of this form for your records</b>
    <h3  style="color:white;background-color: black;">FOR RECIPIENT OF SUBSTANCE ABUSE INFORMATION</h3>
    <TABLE style="width:100%;border: 1px solid black;"> 
        <tr>
            <td>
            <div contentEditable="true" class="text_edit"><?php 
         echo $check_res['text2']??' 
                <p>
                        This information has been disclosed to you from records protected by FederalConfidentialy of alcohol or drug abuse patient record rules(42 CFP part 2),the federal rules prohibit you from making any further disclosure to expressly permitted by the written consent of the person to whom  it pertains or as otherwise permitted by 42 CFP part 2.A general authorization for the release of Medical or other informafion is NOT sufficient for this purpose.The federal rules restrict any use of the information to criminally investigate or prosecute any alcohol or drug abuse patient.
                </p>';?>
                </div><input type="hidden" name="text2" id="text2">

            </td>
        </tr>
    </TABLE><br>
    
<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" id="btn-save" type="submit"  name="sub" value="Submit" >
<button style="  border:1px solid red; padding:10px; background-color:red;  color:white; font-size:16px;" type="button"  onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>

            </form>
</body>

<script>
 
    $('#btn-save') .on('click',function(){
      //  alert(222);exit;
        $('.text_edit').each(function(){
            //alert();
            var dataval = $(this).html();
            $(this).next("input").val(dataval);
           //alert( $(this).next("input").val());
            
        });
        $errocount = 0;
        if($errocount==0)
        {
            $('#my_pat_form').submit();

        }
    });
    </script>
</html>