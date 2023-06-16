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
    $sql = "SELECT * FROM `form_facsimile_coversheet` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();
?>
<html>
    <head>
        <title><?php echo xlt("Blank IRO Form"); ?></title>
        <?php Header::setupHeader(); ?>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;padding-top:20px;">
                <div class="col-12">
                     <h2 class="text-center">Facsimile Transmission Cover Sheet</h2>   
                </div>  
                
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/facsimile_cover_sheet/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />    
                    <hr/>    
                    <div class="col-12 mt-5">    
                            <table style="width:100%;border: "> 
                            <tr>
                            <td style="width:30%; ">
                            <label>DATE:</label>
                            </td>  
                            <td style="width:40%;">
                            <input type="date" id="date" name="date" value="<?php echo text($check_res['date']); ?>" class="form-control"/>
                            </td> 
                            <td style="width:30%;">
                            </td> 
                            </tr>
                            </table>
                            <table style="width:100%;border: "> 
                            <tr>
                            <td style="width:30%; ">
                            <label>TO:</label>
                            </td>  
                            <td style="width:40%;">
                            <input type="text" id="toaddr" name="toaddr" value="<?php echo text($check_res['toaddr']); ?>" class="form-control"/>
                            </td> 
                            <td style="width:30%;">
                            </td> 
                            </tr>
                            </table>
                            <table style="width:100%;border: "> 
                            <tr>
                            <td style="width:30%; ">
                            <label>FAX #:</label>
                            </td>  
                            <td style="width:40%;">
                            <input type="text" id="fax" name="fax" value="<?php echo text($check_res['fax']); ?>" class="form-control"/>
                            </td>  
                            <td style="width:30%;">
                            </td>
                            </tr>
                            </table>
                            <table style="width:100%;border: "> 
                            <tr>
                            <td style="width:30%; ">
                            <label>FROM:</label>
                            </td>  
                            <td style="width:40%;">
                            <input type="text" id="fromaddr" name="fromaddr" value="<?php echo text($check_res['fromaddr']); ?>" class="form-control"/>
                            </td>  
                            <td style="width:30%;">
                            </td>
                            </tr>
                            </table>
                            <table style="width:100%;border: "> 
                            <tr>
                            <td style="width:30%; ">
                            <label>SUBJECT:</label>
                            </td>  
                            <td style="width:40%;">
                            <input type="text" id="subject" name="subject" value="<?php echo text($check_res['subject']); ?>" class="form-control"/>
                            </td>  
                            <td style="width:30%;">
                            </td>
                            </tr>
                            </table>
                            <table style="width:100%;border: "> 
                            <tr>
                            <td style="width:30%; ">
                            <label>TOTAL NUMBER OF PAGES (INCLUDING THIS PAGE):</label>
                            </td>  
                            <td style="width:40%;">
                            <input type="text" id="page" name="page" value="<?php echo text($check_res['page']); ?>" class="form-control"/>
                            </td>  
                            <td style="width:30%;">
                            </td>
                            </tr>
                            </table>
                        </div>
                        <div class="container col-12 mt-2">
                        <h4>Request for IRO(Independent Review Organization)</h4>
                        <h4>Review and Release Form</h4>
                        </div> 
                        <hr/>
                        <div class="form-inline container">
                            <label for="name" class="mb-2 mr-sm-2" style="font-size: 17px;">Patient Name:</label>
                            <input type="text" style="width: 32%;" class="form-control mb-2 mr-sm-2" id="name" name="name" value="<?php echo text($check_res['name']); ?>">
                            <label for="ssn" class="mb-2 mr-sm-2" style="font-size: 17px;">SSN#:</label>
                            <input type="text" style="width: 32%;" class="form-control mb-2 mr-sm-2" id="ssn" name="ssn" value="<?php echo text($check_res['name']); ?>">
                        </div>
                        <div class="form-inline container">
                            <label for="dob" class="mb-2 mr-sm-2" style="font-size: 17px;">Patient Date of Birth:</label>
                            <input type="date" class="form-control mb-2 mr-sm-2" id="dob" name="dob" value="<?php echo text($check_res['dob']); ?>">
                        </div>
                        <div class="form-inline container">
                            <label for="subscriber" class="mb-2 mr-sm-2" style="font-size: 17px;">Subscriber Name (if diffrent):</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" id="subscriber" name="subscriber" value="<?php echo text($check_res['subscriber']); ?>">
                            <label for="relation" class="mb-2 mr-sm-2" style="font-size: 17px;">Relationship to Patient:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" id="relation" name="relation" value="<?php echo text($check_res['relation']); ?>">
                        </div>
                        <div class="form-inline container">
                            <label for="employee" class="mb-2 mr-sm-2" style="font-size: 17px;">Subscriber's Employer Name:</label>
                            <input type="text" style="width: 50%;" class="form-control mb-2 mr-sm-2" id="employee" name="employee" value="<?php echo text($check_res['employee']); ?>">
                        </div>
                        <div class="form-inline container">
                            <label for="coverage" class="mb-2 mr-sm-2" style="font-size: 17px;">Coverage determination that I am appealing:</label>
                            <input type="text" style="width: 50%;" class="form-control mb-2 mr-sm-2" id="coverage" name="coverage" value="<?php echo text($check_res['coverage']); ?>">
                        </div>
                        <div class="container col-12 mt-2">
                            <label style="font-size: 17px;">I am attaching additional information for this appeal:  
                            <input type=checkbox name='check1' value="0"<?php if ($check_res{"check1"} == "0") {
                            echo "checked";};?>> Yes
                            <input type=checkbox name='check2' value="1"<?php if ($check_res{"check2"} == "1") {
                            echo "checked";};?>> No</label>
                        </div> 
                        <hr>
                        <div class="container col-12 mt-2">
                         <p style="font-size: 17px;"><u><b>Please complete this section if you are authorizing someone else to act on your behalf</b></u></p>
                        </div> 
                        <div class="container col-12 mt-2">
                            <p style="font-size: 17px;text-align:justify;">I am authorizing 
                            <input type="text" id="auth" name="auth" value="<?php echo text($check_res['auth']);?>"/> (name of individual)
                            to  act on my behalf in requesting a review in accordance with Cigna's External Review Program regarding the non-coverage
                            determination dated. <input type="text" id="determine" name="determine" value="<?php echo text($check_res['determine']);?>"/>.
                            This authorization allows Cigna to disclose any individually identifying information to my representative.
                            This includes releasing the results of the IRO decision to the above mentioned authorized representative.</p>
                        </div>
                        <div class="form-inline container">
                            <label for="addr" class="mb-2 mr-sm-2" style="font-size: 17px;">Authorized Representative's Address:</label>
                            <input type="text" style="width: 50%;" class="form-control mb-2 mr-sm-2" id="addr" name="addr" value="<?php echo text($check_res['addr']); ?>">
                        </div>
                        <div class="form-inline container">
                            <label for="member" class="mb-2 mr-sm-2" style="font-size: 17px;">Relationship to Member:</label>
                            <input type="text" style="width: 50%;" class="form-control mb-2 mr-sm-2" id="member" name="member" value="<?php echo text($check_res['member']); ?>">
                        </div>
                        <hr>
                        <div class="container col-12 mt-2">
                            <p style="font-size: 17px;text-align:justify;">I understand that IRO will receive and review the following
                            information from Cigna, its Agents or subsidiaries:</p>
                            <ul>
                                <li style="font-size: 16px;">My medical records and other documents that were reviewed during the internal review process.</li>
                                <li style="font-size: 16px;">Documents from the internal review process, including a statement of the 
                                criteria and clinical reasons for the initial coverage decision.</li>
                                <li style="font-size: 16px;">The contact document for my health care benefit plan (the description of my coverage).</li>
                                <li style="font-size: 16px;">Any additional information not presented during the internal review process related to the appeal.</li>
                            </ul>
                            <p style="font-size: 17px;text-align:justify;">I understand that I may submit additional information related to this appeal
                            <b>WITH THIS FORM</b> to be considered in the external review process. I understand that the decision of the IRO's reviewer(s)
                            will be binding on Cigna and on me, except to the extent that there are other remedies available under State or Federal law.
                            I understand that my appeal to an IRO cannot begin until I have submitted all required information. I understand
                            I must provide the information requested below  and if applicable, sign the release of records form which allows Cigna to 
                            forward certain information to the IRO. I understand that any form retuned to Cigna incomplete will be returned to me for completion 
                            and my appeal will not be forwarded to the IRO untill I complete the form and provide all requested information.</p>
                            <p  style="font-size: 15px;"><b>I have read and understand the above information.</b></p>
                        </div>
                        <div class="form-inline container">
                            <label for="patient" class="mb-2 mr-sm-2" style="font-size: 17px;"><b>Signature of the patient electing appeal:</b></label>
                            <input type="text" style="width: 32%;" class="form-control mb-2 mr-sm-2" id="patient" name="patient" value="<?php echo text($check_res['patient']); ?>">
                            <label for="patdate" class="mb-2 mr-sm-2" style="font-size: 17px;"><b>Date:</b></label>
                            <input type="date" class="form-control mb-2 mr-sm-2" id="patdate" name="patdate" value="<?php echo text($check_res['patdate']); ?>">
                            <p style="font-size: 17px;text-align:justify;">If patient is unable to give consent because of physical condition or age , complete the following:</p>
                            <p style="font-size: 17px;text-align:justify;">Patient is a minor
                            <input type="text" id="minor" name="minor" value="<?php echo text($check_res['minor']);?>"/> Years of age
                            or is unable to give consent, because <input type="text" id="consent" name="consent" value="<?php echo text($check_res['consent']);?>"/>.</p>
                            <label for="guardian" class="mb-2 mr-sm-2" style="font-size: 17px;"><b>Signature of the parent/Guardian/POA:</b></label>
                            <input type="text" class="form-control mb-2 mr-sm-2" id="guardian" name="guardian" value="<?php echo text($check_res['guardian']); ?>"/>
                            <label for="guarddate" class="mb-2 mr-sm-2" style="font-size: 17px;"><b>Date:</b></label>
                            <input type="date" class="form-control mb-2 mr-sm-2" id="guarddate" name="guarddate" value="<?php echo text($check_res['guarddate']); ?>"/>
                        </div>
                        <div class="form-inline container">
                            <label for="relation1" class="mb-2 mr-sm-2" style="font-size: 17px;"><b>Relationship:</b></label>
                            <input type="text" style="width: 32%;" class="form-control mb-2 mr-sm-2" id="relation1" name="relation1" value="<?php echo text($check_res['relation1']); ?>">
                        </div>
                        <div class="container col-12 mt-2">
                            <p style="font-size: 17px;text-align:justify;">Return Completed From To:<b>Cigna Behavioral Health,
                                Attn:Central Appeals Unit, P.O.Box 46090, Eden Prairie, MN 55354. Fax#:855-816-3497</b></p>
                            <p style="text-align:justify;">"cigna" is a registered  service mark and the "Tree of Life" logo is a service mark of
                            Cigna Intellectual Property, Inc., licensed for  use by Cigna Corparation and its operating subsidiaries. All products
                            and services are provided by or through such operating subsidiaries and not by Cigna Corparation. Such operating 
                            subsidiaries include connecticut General Life Insurance Company, Cigna Health and Life Insurance Company, 
                            Cigna Health Management, Inc, and HMO or service company subsidiaries of Cigna Health Corparation.
                            Please refer to your ID card for the subsidiary that insures or administers your benefit plan.</p>
                        </div>
                        <div class="form-group">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style="margin-left: 15px;"><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-danger btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
