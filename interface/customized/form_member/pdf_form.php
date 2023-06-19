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

    $sql = "SELECT * FROM `form_member` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'oxford_form.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>


<style>
        
</style>
<body id='body' class='body'>
<?php
// $header ="<div class='row'style='line-height:1px;' >
// </div>";
ob_start();
?>




    <h2>Designation of Representative /Authorization Form    </h2>
    <p>This form is to be filled out by a member if there is a request to release the member’s health information to another person or company or a request to appoint an Authorized Representative. Please include as much information as you can.
    </p>
    <h3 style="color:white;background-color: black;">PART A:MEMBER INFORMATION</h3>
    <table style="margin-top: 8px;width:100%"> 
        <tr>
        <td style="width:25%;border:2px solid black;"> 
        <label style="font-size:14px;"> Member last Name: </label><br>
        <?php echo text($check_res['lname']);?>
        </td>
        <td style="width:25%;border:2px solid black;"> 
        <label style="font-size: 14px;"> Member first Name:</label><br>
        <?php echo text($check_res['fname']);?>

        </td>
            <td style="width:25%;border:2px solid black;"> 
            <label style="font-size: 14px;">Middle initial:</label><br>
            <?php echo text($check_res['minitial']);?>

            </td>
                <td style="width:25%;border:2px solid black;"> 
                <label style="font-size: 14px;"> Member Date Of Birth:</label><br>
                <?php echo text($check_res['dob']);?>

                </td>
                </tr>
                <tr>
                    <td style="width:25%;border:2px solid black;"> 
                    <label style="font-size: 14px;">Member street address: </label><br>
                    <?php echo text($check_res['address']);?>

                    </td>
                    <td style="width:25%;border:2px solid black;"> 
                    <label style="font-size: 14px;">City:</label><br>
                    <?php echo text($check_res['city']);?>

                    </td>
                        <td style="width:25%;border:2px solid black;"> 
                        <label style="font-size: 14px;">State:</label><br>
                        <?php echo text($check_res['state']);?>

                        </td>
                            <td style="width:25%;border:2px solid black;"> 
                            <label style="font-size: 14px;">Zipcode:</label><br>
                            <?php echo text($check_res['zipcode']);?>

                            </td>
                          </tr>
            <tr>
              <td style="width:25%;border:2px solid black;"> 
                  <label style="font-size: 14px;">Daytime phone number(with area code)    </label><br>
                  <?php echo text($check_res['pnumber']);?>

                     </td>
                     <td style="width:25%;border:2px solid black;"> 
                     <label style="font-size: 14px;">ldentificaton number(see identification card):</label><br>
                     <?php echo text($check_res['inumber']);?>

                         </td>
                    <td colspan="2" style="width:50%;border:2px solid black;"> 
                   <label style="font-size: 14px;">Group number(see identification card):</label><br>
                   <?php echo text($check_res['gnumber']);?>

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
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;My Spouse(enter first and lastname) <br>
                    <?php echo text($check_res['cinput1']);?>
            </td>
            <td style="width:50%;border:2px solid black;"> 
                <input type="checkbox" name="checkbox2"   value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;My domestic partner(enter first and lastname)
                <br>
                <?php echo text($check_res['cinput2']);?>
    
            </td>
                    </tr>
                    <tr>
                        <td style="width:50%;border:2px solid black;"> 
                            <input type="checkbox" name="checkbox3"   value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;My adult children (enter first and last name[s])<br>
                    <?php echo text($check_res['cinput3']);?>
                        </td>
                        <td style="width:50%;border:2px solid black;"> 
                            <input type="checkbox" name="checkbox4"   value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Myinsurance broker or agent(enter the name of the company and first and lastname, if you have it)

                            <br>
                            <?php echo text($check_res['cinput4']);?>
                        </td>
                              </tr>
                <tr>
                    <td style="width:50%;border:2px solid black;"> 
                        <input type="checkbox" vame="checkbox4_1"   value="1" <?php if ($check_res['checkbox4_1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;My parents (if you are over 18 -enter first and last name[s])<br>
                            <?php echo text($check_res['cinput4_1']);?>
                    </td>
                    <td style="width:50%;border:2px solid black;"> 
                        <input type="checkbox" name="checkbox5"   value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;0ther(enter first and last name {if you have it} name of company, and how it’s related to you)


                        <br>
                        <?php echo text($check_res['cinput5']);?>
                    </td>
                            </tr>
                                        
            </table>
            <h3 style="color:white;background-color: black;">PART C:INFORMATION THAT CAN BE RELEASED</h3>
            <P>I allow the following information to be used or released by Anthem Blue Cross on my behalf(check only one box):
            </P>
            <input type="checkbox" name="checkbox6"   value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;All my information. This  can  include  health, a diagnosis(name of illness or condition), claims, doctors and other health care
            producers  and  financial information(like billing and banking).this doesn’t include sensitive  information
            (see below) unless it is apporved below.
            <p>OR</p>
            <input type="checkbox" name="checkbox7"   value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Only limited informafion may be released (check if all boxes below (that apply to you).<br>

            <table style="margin-top: 8px;width:100%"> 
<tr>
<td style="width:30%;"> 
<input type="checkbox" name="checkbox8"   value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Appeal
</td>
<td style="width:30%;"> 
<input type="checkbox" name="checkbox9"   value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Eligibility and enrollment
</td>
<td style="width:30%;"> 
<input type="checkbox" name="checkbox10"   value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Referral
</td>

</tr> 
<tr>
<td style="width:30%;"> 
<input type="checkbox" name="checkbox11"   value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Benefits and Coverage
</td>
<td style="width:30%;"> 
    <input type="checkbox" name="checkbox12"   value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Financial
    </td>
    <td style="width:30%;"> 
        <input type="checkbox" name="checkbox13"   value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Treatment
        </td>

    </tr>  <tr>
    <td style="width:30%;"> 
        <input type="checkbox" name="checkbox14"   value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;billing
        </td>
        <td style="width:30%;"> 
            <input type="checkbox" name="checkbox15"   value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Medical records
            </td>
            <td style="width:30%;"> 
                <input type="checkbox" name="checkbox16"   value="1" <?php if ($check_res['checkbox16'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Dental
                </td>

            </tr>  <tr>
            <td style="width:30%;"> 
                <input type="checkbox" name="checkbox17"   value="1" <?php if ($check_res['checkbox17'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Appeal
                </td>
                <td style="width:30%;"> 
                    <input type="checkbox" name="checkbox18"   value="1" <?php if ($check_res['checkbox18'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Eligibility and enrollment
                    </td>
                    <td style="width:30%;"> 
                        <input type="checkbox" name="checkbox19"   value="1" <?php if ($check_res['checkbox19'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Referral
                        </td>

                    </tr>  <tr>
                    <td style="width:30%;"> 
                        <input type="checkbox" name="checkbox20"   value="1" <?php if ($check_res['checkbox20'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;claims and payment
                        </td>
                        <td style="width:30%;"> 
                            <input type="checkbox" name="checkbox21"   value="1" <?php if ($check_res['checkbox21'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;doctor and hospital
                            </td>
                            <td style="width:30%;"> 
                                <input type="checkbox" name="checkbox22"   value="1" <?php if ($check_res['checkbox22'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;vision
                                </td>
    
                            </tr> 
            <tr>
                <td style="width:30%;"> 
                    <input type="checkbox" name="checkbox26"   value="1" <?php if ($check_res['checkbox26'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Diagnosis(name of illness or condition) and procedure Treatment
                    </td>
                    <td style="width:30%;"> 
                        <input type="checkbox" name="checkbox27"   value="1" <?php if ($check_res['checkbox27'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;pre certification and pre authorization(for treatment)
                        </td>
                        <td style="width:30%;"> 
                            <input type="checkbox" name="checkbox28"   value="1" <?php if ($check_res['checkbox28'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Pharmacy
                            </td>

                        </tr> 
                        <tr>
                            <td style="width:30%;"> 
                                <tr>
                                    <td style="width:30%;"> 
                                        <input type="checkbox" name="checkbox29"   value="1" <?php if ($check_res['checkbox29'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Other:
                                        <?php echo text($check_res['cinput6']);?>
                                    </td>
            
                                    </tr> 
</table>
<hr/>
<p>I also approve the release of the foIlowing  types of  sensitive  information by Anthem Blue Cross(check all  boxes  that  apply to you): </p>

<input type="checkbox" name="checkbox30"   value="1" <?php if ($check_res['checkbox30'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;<b>All sensitive informafion;OR</b><br>
<input type="checkbox" name="checkbox31"   value="1" <?php if ($check_res['checkbox31'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;<b>Just informafion about topics </b><br>
<table> 
    <tr>
        <td style="width:30%;"> 
            <input type="checkbox" name="checkbox32"   value="1" <?php if ($check_res['checkbox32'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Abortion:
        </td>
        <td style="width:30%;"> 
            <input type="checkbox" name="checkbox33"   value="1" <?php if ($check_res['checkbox33'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Genetic testing:
        </td>
        <td style="width:30%;"> 
            <input type="checkbox" name="checkbox34"   value="1" <?php if ($check_res['checkbox34'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Mental health:
        </td>

        </tr> 
        <tr>
            <td style="width:30%;"> 
                <input type="checkbox" name="checkbox35"   value="1" <?php if ($check_res['checkbox35'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Abuse(physically/mental/sexual):
            </td>
            <td style="width:30%;"> 
                <input type="checkbox" name="checkbox36"   value="1" <?php if ($check_res['checkbox36'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;HIV or AIDS:
            </td>
            <td style="width:30%;"> 
                <input type="checkbox" name="checkbox37"   value="1" <?php if ($check_res['checkbox37'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Sexually transmitted illness :
            </td>
    
            </tr> 
            <tr>
                <td style="width:30%;"> 
                    <input type="checkbox" name="checkbox38"   value="1" <?php if ($check_res['checkbox38'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Alcohol/substance abuse:
                </td>
                <td style="width:30%;"> 
                    <input type="checkbox" name="checkbox39"   value="1" <?php if ($check_res['checkbox39'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Maternity:
                </td>
                <td style="width:30%;"> 
                    <input type="checkbox" name="checkbox40"   value="1" <?php if ($check_res['checkbox40'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;other:   <?php echo text($check_res['cinput7']);?>

                </td>
        
                </tr> 
</table>
<hr>
<p>Anthem Blue Cross is the trade name of Blue Cross of California. Anthem Blue Cross and Anthem Blue Cross Life and  Health Insurance Company are independent : licensees of the Blue Cross Association. @ anthem is a registered trademark  of anthem
    Insurance Companies, Inc. The Blue Cross name and symbol are registered marks of the Blue Cross Association. Utilization review may be provided by Anthem UM Services, Inc., a separate company.
    </p>
    <h3 style="color:white;background-color: black;">PART D:PERSON OR COMPANY THAT CAN BE ACT AS AUTHORIZED REPRESENTATIVE</h3>
    <p>The  following  person or company has the right to act as my Authorized Representative. An Authorized Representative is a person who you appoint to be your representative in carrying out a grievance or appeal, including any external review rights  that  may  be available to you. They must be 18 years of age or older. Please also complete Part B and C above to authorize the release of you information to your Authorized Representative..</p>
    <table style="margin-top: 8px;width:100%"> 
        <tr>
        <td style="width:50%;border:2px solid black;"> 
            <input type="checkbox" name="checkbox41"   value="1" <?php if ($check_res['checkbox41'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;My spouse(enter first and lastname)<br>
                <?php echo text($check_res['cinput8']);?>
        </td>
        <td style="width:50%;border:2px solid black;"> 
            <input type="checkbox" name="checkbox42"   value="1" <?php if ($check_res['checkbox42'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;My domestic partner(enter first and lastname)
            <br>
            <?php echo text($check_res['cinput9']);?>

        </td>
                </tr>
                <tr>
                    <td style="width:50%;border:2px solid black;"> 
                        <input type="checkbox" name="checkbox43"   value="1" <?php if ($check_res['checkbox43'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;My adult children (enter first and last name[s])<br>
                            <?php echo text($check_res['cinput10']);?>
                    </td>
                    <td style="width:50%;border:2px solid black;"> 
                        <input type="checkbox" name="checkbox44"   value="1" <?php if ($check_res['checkbox44'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Myinsurance broker or agent(enter the name of the company and first and lastname, if you have it)

                        <br>
                        <?php echo text($check_res['cinput11']);?>
                    </td>
                          </tr>
            <tr>
                <td style="width:50%;border:2px solid black;"> 
                    <input type="checkbox" name="checkbox45"   value="1" <?php if ($check_res['checkbox45'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;My parents (if you are over 18 -enter first and last name[s])<br>
                        <?php echo text($check_res['cinput12']);?>
                </td>
                <td style="width:50%;border:2px solid black;"> 
                    <input type="checkbox" name="checkbox46"   value="1" <?php if ($check_res['checkbox46'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;0ther(enter first and last name {if you have it} name of company, and how it’s related to you)


                    <br>
                    <?php echo text($check_res['cinput13']);?>
                </td>
                        </tr>
                                    
        </table>
        <h3 style="color:white;background-color: black;">PART E:DATE YOUR APPROVAL EXPIRES</h3>
        <p>If this document was not already withdrawn, this approval will end:</p>
        <input type="checkbox" name="checkbox47"   value="1" <?php if ($check_res['checkbox47'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;At the conclusion of the appeals process<br>
        <input type="checkbox" name="checkbox48"   value="1" <?php if ($check_res['checkbox48'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;One year from the signature in part G<br>
        <input type="checkbox" name="checkbox49"   value="1" <?php if ($check_res['checkbox49'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Upon the date or event or condition described below(please provide details)<br>

        <h3 style="color:white;background-color: black;">PART F:PURPOSE OF THIS APPROVAL</h3>
        <input type="checkbox" name="checkbox50"   value="1" <?php if ($check_res['checkbox50'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;To allow an individual to act as my Authorized Repesentative in carrying out a grievance or appeal, including any external review right that may be available to me. <br>

        <input type="checkbox" name="checkbox51"   value="1" <?php if ($check_res['checkbox51'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;To disclose informaton at my request. <br>

        <h3 style="color:white;background-color: black;">PART G:REVIEW AND APPROVAL</h3>
        <?php
                        if(isset($check_res['text1'])){
                             echo $check_res['text1']; 
                        } else{
                            ?>
        <P>I have read the contents of this form. I understand, agree, and allow  Anthem Blue Cross to  the use and release of my information as I have stated above. I also understand that signing this form is  of my own free will. I understand the  /Anthem Blue Cross does not require that I sign this form  inorder for me to  receive treatment or payment, or far enrollment or being eligible for benefits.
        <br><br> I have the right to withdraw this approval at any time by giving written notice of my withdrawal to Anthem Blue Cross. I understand that my withdrawing this approval do  not affect any action  taken  before I do so. I also understand that information that released may be given out by the person or group who receives it. If this happens, it may no longer be protected under the HIPAA Privacy Rule. I am entitled to a copy of this form</P>
        <?php
            }
             ?>
<table style="width: 100%;">
    <tr>
    <td style="width:75%;border:2px solid black;"> 
        <label style="font-size: 14px;">Member signature or Designated Legal Representative/Guardian signature :</label><br>
        <?php echo text($check_res['signature']);?>

           </td>
           <td style="width:25%;border:2px solid black;"> 
           <label style="font-size: 14px;">date:</label><br>
           <?php echo text($check_res['date']);?>

               </td>
            </tr>
</table>

            <h3  style="color:white;background-color: black;">DESIGNATED LEGAL REPRESENTATIVE GUARDIAN</h3>
    <p>If this form is signed other then by member or parent such as legal representative,personal Representative or guardian on behalf of the member.please submit the below:</p>
    <ul>
        <li>A Copy of the healthcare,general or Durable power of attorney OR</li>
        <li>A court order or other documentation that shows custody or other legal documentaion showing the authority of the legal to act as a Representative to act on the members  behalf</li>

        <p>Please Complete the following</p>
    </ul>

    <label style="font-size:14px;"> legal representative (print full Name) :</label>
    <?php echo text($check_res['lename']);?><br>

        <label style="font-size:14px;">legal relationship to member:</label>
        <?php echo text($check_res['lrelation']);?><br>
                <label style="font-size: 14px;">legal representative street address: </label>
                <?php echo text($check_res['laddress']);?><br>
                <label style="font-size: 14px;">City:</label>
                <?php echo text($check_res['lcity']);?><br>
                    <label style="font-size: 14px;">State:</label>
                    <?php echo text($check_res['lstate']);?><br>

                        <label style="font-size: 14px;">Zipcode:</label>
                        <?php echo text($check_res['lzipcode']);?><br>

              <label style="font-size: 14px;">Signature   </label>
              <?php echo text($check_res['signature2']);?><br>
                 <label style="font-size: 14px;">Date:</label>
                 <?php echo text($check_res['date2']);?><br>
<br>
    <p>Please return the completed form to<br>Grievances and Appeals <br> P.O Box 4310 <br>Woodland Hills,CA 91365</p>
    <b>Be sure to keep a copy of this form for your records</b>
    <h3  style="color:white;background-color: black;">FOR RECIPIENT OF SUBSTANCE ABUSE INFORMATION</h3>
    <TABLE style="width:100%;border: 1px solid black;"> 
        <tr>
            <td>
            <?php
                        if(isset($check_res['text2'])){
                             echo $check_res['text2']; 
                        } else{
                            ?>
                <p>
                        This information has been disclosed to you from records protected by FederalConfidentialy of alcohol or drug abuse patient record rules(42 CFP part 2),the federal rules prohibit you from making any further disclosure to expressly permitted by the written consent of the person to whom  it pertains or as otherwise permitted by 42 CFP part 2.A general authorization for the release of Medical or other informafion is NOT sufficient for this purpose.The federal rules restrict any use of the information to crinimally investigate or prosecute any alcohol or drug abuse patient.
                </p>
                <?php
            }
             ?>
            </td>
        </tr>
    </TABLE>


<?php
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Member_form");
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

?>