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
    $sql = "SELECT * FROM `form_providence_healthplan` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Member Consent For UBH"); ?></title>
        <?php Header::setupHeader(); ?>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row" style="border:1px solid black;">
                <div class="col-12" style="border:1px solid black;">
                     <h3>Providence Health Plans</h3>
                     <h3>Policy and Procedure</h3>
                </div>  
                <form method="post" name="my_form" id="my_pat_form" action="<?php echo $rootdir; ?>/forms/providence_health_plan/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />    
                        <table style="width:100%;border: 1px solid black;border-collapse: collapse;"> 
                        <tr>
                        <td style="width:50%;border: 1px solid black;border-collapse: collapse;">
                        <h5>SUBJECT:</h5>
                        <p><b>Appointment of Authorized Member Representatives</b></p>
                        </td>  
                        <td style="width:50%;">
                        <h5>NUMBER:</h5>
                        <p>AP<input type="text" style="margin-left: 26px;margin-top: -23px;width: 50%;" id="appoin" name="appoin" value="<?php echo text($check_res['appoin']); ?>" class="form-control"/></p>
                        </td>  
                        </tr>
                        </table>
                        <div class="col-12 mt-2">
                        <p style="font-size:17px;"><b>1.Attachment 1: Form for Appointment of Authorized Representative and Provider Release of 
                            Balance Billing Rights</b></p>
                        </div> 
                        <div class="container col-12 "> 
                        <table style="width:100%;border: "> 
                        <tr>
                        <td style="width:30%; ">
                        <label>Member Name:</label>
                        </td>  
                        <td style="width:40%;">
                        <input type="text" id="name" name="name" value="<?php echo text($check_res['name']); ?>" class="form-control"/>
                         </td> 
                         <td style="width:30%;">
                         </td> 
                        </tr>
                        </table>
                        <table style="width:100%;border: "> 
                        <tr>
                        <td style="width:30%; ">
                        <label>Member Number:</label>
                        </td>  
                        <td style="width:40%;">
                        <input type="text" id="member" name="member" value="<?php echo text($check_res['member']); ?>" class="form-control"/>
                         </td> 
                         <td style="width:30%;">
                         </td> 
                        </tr>
                        </table>
                        <table style="width:100%;border: "> 
                        <tr>
                        <td style="width:30%; ">
                        <label>Group Number:</label>
                        </td>  
                        <td style="width:40%;">
                        <input type="text" id="group" name="group" value="<?php echo text($check_res['groups']); ?>" class="form-control"/>
                         </td>  
                         <td style="width:30%;">
                         </td>
                        </tr>
                        </table>
                        <div class="container col-12 mt-2">
                        <p style="font-size:17px;text-align:center;"><b>MEMBER DESIGNATION OF AUTHORIZED REPRESENTATIVE</b></p>
                        </div> 
                    <div class="container col-12 mt-2">
                        <p style="font-size: 17px;">I</p>
                      
                        <input type="text" id="first" name="first" value="<?php echo text($check_res['first']); ?>" class="form-control" style="margin-left: 13px;margin-top: -36px;width: 290px;">
                        <p style="margin-left: 310px;margin-top: -30px;font-size: 17px;">, hereby grant</p>
                        <input type="text" id="second" name="second" value="<?php echo text($check_res['second']); ?>" class="form-control" style="width: 430px;margin-left: 422px;margin-top: -46px;" >
                        <p style="font-size: 17px;text-align:justify;">authority to act on my behalf as my authorized representative in pursing and
                        appealing benefit determinations under my plan related to the following claim number(s).</p>:
                        <input type="text" id="third" name="third" value="<?php echo text($check_res['third']); ?>" class="form-control" style="margin-left: 202px;margin-top: -61px;width: 77%;" >   
                        <div contentEditable="true" class="text_edit"><?php 
                        echo $check_res['text1']??'     
                        <p style="font-size: 17px;text-align:justify;">All communication regarding any such appeals should be sent to my authorized representative
                        in lieu of me.</p>
                        <p style="font-size: 17px;text-align:justify;">My designee is an individual  and not a business entity. If  my designee
                        is a medical provider or a person affiliated with a medical provider, I understand that am under no legal obligation to grant 
                        authority to the provider to act as my authorized representative. That authority has value to the provider, especially to
                        to the extent I have already assigned benefits under my plan to the provider. Therefore, my grant to the provider of authority to pursue benefits on my behalf is conditioned
                        on full release of any claim the provider, or his or her employer, business partners, or any business affiliate of the provider
                        has against me personally for services at issue in the appeal(s) as set out in the form required by Providence Helath Plan.
                        The release is intended to extinguish the conflict of interest the provider would otherwise have in holding me accountable for non-covered 
                        charges while also asserting my rights against the plan. </p>';?>
                        </div><input type="hidden" name="text1" id="text1">
                    </div>
                    <div class="col-12 row mt-2">   
                        <div class="col-6" style="display:flex;">
                            <label style="font-size: 17px;">Member's Signature : </label>
                                <div class="form-group">
                                    <input type="text" id="sign" name="sign" value="<?php echo text($check_res['sign']); ?>" class="form-control" />
                                    
                                </div>
                        </div>   
                        <div class="col-6" style="display:flex;">
                            <label style="font-size: 17px;"><?php echo xlt('Date:'); ?></label>
                                <div class="form-group">
                                    <input type="date" id="date" name="date" value="<?php echo text($check_res['date']); ?>" class="form-control">
                                   
                                </div>
                        </div> 
                    </div>
                    <!-- <div class="col-12" style="border:1px solid black;">
                        <h3>Providence Health Plans</h3>
                        <h3>Policy and Procedure</h3>
                    </div>  
                    <table style="width:100%;border: 1px solid black;border-collapse: collapse;"> 
                        <tr>
                        <td style="width:50%;border: 1px solid black;border-collapse: collapse;">
                        <h5>SUBJECT:</h5>
                        <p><b>Appoinment of Authorized Member Representatives</b></p>
                        </td>  
                        <td style="width:50%;">
                        <h5>NUMBER:</h5>
                        <p>AP<input type="text" style="margin-left: 26px;margin-top: -23px;width: 50%;" id="appoin1" name="appoin1" value="<?php echo text($check_res['appoin1']); ?>" class="form-control"/>
                         </td>  
                        </tr>
                        </table> -->
                        <div class="col-12 mt-2">
                        <p style="font-size:17px;"><b>2.Attachment 2: Mandatory Provider Release of Balance Billing Rights</b></p>
                        </div> 
                        <div class="container col-12 "> 
                        <table style="width:100%;border: "> 
                        <tr>
                        <td style="width:30%; ">
                        <label>Member Name:</label>
                        </td>  
                        <td style="width:40%;">
                        <input type="text" id="name1" name="name1" value="<?php echo text($check_res['name1']); ?>" class="form-control"/>
                         </td> 
                         <td style="width:30%;">
                         </td> 
                        </tr>
                        </table>
                        <table style="width:100%;border: "> 
                        <tr>
                        <td style="width:30%; ">
                        <label>Member Number:</label>
                        </td>  
                        <td style="width:40%;">
                        <input type="text" id="member1" name="member1" value="<?php echo text($check_res['member1']); ?>" class="form-control"/>
                         </td> 
                         <td style="width:30%;">
                         </td> 
                        </tr>
                        </table>
                        <table style="width:100%;border: "> 
                        <tr>
                        <td style="width:30%; ">
                        <label>Group Number:</label>
                        </td>  
                        <td style="width:40%;">
                        <input type="text" id="group1" name="group1" value="<?php echo text($check_res['group1']); ?>" class="form-control"/>
                         </td>  
                         <td style="width:30%;">
                         </td>
                        </tr>
                    </table>
                    <div class="container col-12 mt-2">
                        <p style="font-size:17px;text-align:center;"><b>REQUIREMENTS FOR DESIGNATION OF A PROVIDER AS AUTHORIZED REPRESENTATIVE</b></p>
                    </div> 
                    <div class="container col-12 mt-2">
                    <div contentEditable="true" class="text_edit"><?php 
                        echo $check_res['text2']??" 
                        <p style='font-size: 17px;text-align:justify;'>Providence members have the right to designate an authorized
                        representative to act on their behalf in pursing a benefit claim or appeal of an adverse benefit determination. 
                        An authorized representative must be individual, as opposed to a business entity. If the individual the member
                        designates is a medical provider or someone affiliated with a medical provider, there is an additional requirement that
                        the provider waive whatever rights it may have against the member unless the claims relates to urgent care.</p>
                        <p style='font-size: 17px;text-align:justify;'>The reason for this requirement is to avoid conflicts of interest. In some instances 
                        provider acquire rights of payment against their patients even when the patient has health coverage. For example,
                        regardless of whether a provider paticipates in Providence's provider network, if Providence denies coverage of a service rendered to the member
                        the provider may have rights against the member for costs of non-covered medical services. Furthermore, when a provider is
                        not under contract with Providence and is therefore 'out-of-network', the provider may have the right to charge
                        the member for the amount they bill Providence less the amount paid by providence less the amount paid by Providence 
                        under the out-of-network terms of the member's plan. The practice of charging a member for that amount is known as 'balance billing'.</p>
                        <p style='font-size: 17px;text-align:justify;'>For example, if a member receives medical services from an
                        out-of-network provider and the provider bills Providence $1000 for those services, the members plan will not cover
                        that entire amount. First, the billed amount is reduced to an amount consistent with 'Usual and Customary Rates'.
                        Providence determines the usual and customary rate for a particular service by referencing a database maintained by a 
                        national independent, not-for-profit corporation called FAIR Health. (See<a href='http://www.fairhealthconsumer.org/'> http://www.fairhealthconsumer.org/</a>). If the UCR
                        rate in the FAIR Health database is lower than the billed amount ,such as $500 instead of the $1000 billed amount,
                        the amount Providence will pay on the claim is determined by the UCR Rate.</p>
                        <p style='font-size: 17px;text-align:justify;'>Once the UCR rate is determined, Providence pays the percentage
                        of out-of-network benefits called for in the plan.For example, if the UCR rate is $500, and the plan pays 60
                        percent for out-of-network care, Providence will pay the provider $300. However, if the provider initially billed $1000 
                        for the services and the provider is not under contract with Providence, the provider may be able to bill the member the remaining
                        $700 under applicable law.</p>
                        <p style='font-size: 17px;text-align:justify;'>If a provider were to act as a member's authorized representative
                        while simultaneously holding rights to bill the member for the post-appeal balance, that provider would be in a conflicted 
                        in position. Therefore, providence does not permit a member to designate a provider as an authorized
                        representative unless the provider waives its rights against the member by signing the attached form. The only 
                        exception to that requirement is for claims involving urgent care, meaning a pre-service claim for medical care or treatement with 
                        respect to which normal timeline for pre-service.</p>
                   
                            <p style='font-size: 17px;text-align:justify;'>claims could seriously jeopardize the life or health
                            of the member or the ability of the member to regain maximum function, or would subject the member to severe 
                            pain that cannot be adequately managed without the care or treatement that is the subject of the claim. The provider
                            is not permitted to remain as the member's authorized representative for any post-service grievance processes 
                            absent a balance billing waiver.</p>
                            <p style='font-size: 17px;text-align:justify;'>If your provider is not willing to waive its rights 
                            against you by signing the attached form for your claim for non-urgent care, you are free to appoint any other 
                            individual to act as your authorized representative who would not be operating under a conflict of interest.</p>"?></div>
                            <input type="hidden" name="text2" id="text2">
                        </div>
                        <div class="container col-12 mt-2">
                            <p style="font-size:17px;text-align:center;"><b>RELEASE OF BALANCE BILLING RIGHTS</b></p>
                        </div> 
                        <div class="container col-12 mt-2">
                            <p style="font-size:17px;text-align:center;">(release to be completed by the provider,not a person affiliated with the provider)</p>
                        </div> 
                        <div class="container col-12 mt-2">
                            <p style="font-size: 17px;text-align:justify;">I,</p>
                            <input type="text" id="fourth" name="fourth" value="<?php echo text($check_res['fourth']); ?>" class="form-control" style="margin-left: 13px;margin-top: -36px;width:99%;">
                            <p style="font-size: 17px;text-align:justify;">, hereby waive and release any and all rights that I, my employer, my  business partners
                            ,any business in which I have an interest,or any business with which I am otherwise affiliated may have to collect 
                            payment from the  above-named member,
                            <input type="text" id="fifth" name="fifth" value="<?php echo text($check_res['fifth']); ?>" class="form-control" />
                             ,with respect to any services at issue in any appeal that
                            has been filed or is hereafter filled in which I or a person affiliated with me acts as the member's authorized 
                            representative, regardless of the outcome of the appeal. I have authority to bind the third-parties described
                            in the previous sentence to this release.</p>
                        </div>
                        <div class="col-12 row">   
                            <div class="col-6" style="display:flex;">
                                <label style="font-size: 17px;"><?php echo xlt('Provider Signature :'); ?></label>
                                    <div class="form-group">
                                        <input type="text" id="provider" name="provider" value="<?php echo text($check_res['provider']); ?>" class="form-control" />
                                        
                                    </div>
                            </div>   
                            <div class="col-6" style="display:flex;">
                                <label style="font-size: 17px;"><?php echo xlt('Printed Name:'); ?></label>
                                    <div class="form-group">
                                        <input type="text" id="print" name="print" value=" <?php echo text($check_res['print']); ?>" class="form-control">
                                    
                                    </div>
                            </div> 
                        </div>
                        <div class="col-12">
                            <label style="font-size: 17px;"><?php echo xlt('Date:'); ?></label>
                                <div class="form-group">
                                    <input type="date" id="dat" name="dat" value="<?php echo text($check_res['dat']); ?>" class="form-control" style="margin-left:43px; margin-top:-33px;width:250px;">
                                </div>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../forms/admission_orders/assets/js/jquery.signature.min.js"></script>
<script>
 
    $('.btn-save') .on('click',function(){
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


