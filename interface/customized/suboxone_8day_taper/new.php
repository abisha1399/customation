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
    $sql = "SELECT * FROM `form_suboxone_8day_taper` WHERE id=? AND pid = ? AND encounter = ?";
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
        <title><?php echo xlt("Suboxone 8 day Taper/Heroin"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href=" ../../forms/admission_orders/assets/css/jquery.signature.css">
    </head> 
    <body>
        <div class="container mt-2">
            <div class="row" style="border:1px solid black;"> 
                <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/suboxone_8day_taper/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />       
                    <div class="col-12 mt-3">    
                    <table style="width:100%;border:1px solid #dee2e6;border-bottom-style:none;"> 
                            <tr>
                                <td style="width:100%; ">
                                    <h4 class="mt-3 ml-1"><b>Suboxone 8 day Taper/Heroin/Other Opioids DEA # RC0559611/ZC0559611A</b></h4>
                                </td> 
                            </tr>
                        </table>
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <th style="width: 15%;"><label>Patient Name:</label> 
                                <label><input type="text" style="width:105%;" name="patient" value="<?php echo text($check_res['patient']);?>"/></label></th>
                                <th colspan="6" style="text-align:center">DOB: 
                                <input type="date" name="dob" value="<?php echo text($check_res['dob']);?>"/></label></th>
                                <th><label>Allergies:</label>
                                <label><input type="text" style="width:105%;" name="allergy" value="<?php echo text($check_res['allergy']);?>"/></label>
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Medication, Dosage, Frequency & Rotate</th>
                                <th>Hour</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th>Nurse/Patient Initials</th>
                                <th></th>                                
                            </tr>
                            <tr>
                                <td>
                                    <label>Suboxone 4mg SL BID and <b>8mg SL at 1230</b> on day of admission Date:</label> <label><input type="date" name="date1" style="width:88%;" value="<?php echo text($check_res['date1']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td> 
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign1" id="ptsign1" style="width:60%;" value="<?php echo text($check_res['ptsign1']);?>"/>
                                    <img src='' class="img" id="img_ptsign1" style="display:none;width:50%;height:100px;">  
<!--     
                                    <input type="text" name="ptsign1" class="form-control" value="<?php echo text($check_res['ptsign1']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>12.30 PM</b></td>                               
                                <td> 
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign2" id="ptsign2" style="width:60%;" value="<?php echo text($check_res['ptsign2']);?>"/>
                                    <img src='' class="img" id="img_ptsign2" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign2" class="form-control" value="<?php echo text($check_res['ptsign2']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>04.00 PM</b></td>                               
                                <td> 
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign3" id="ptsign3" style="width:60%;" value="<?php echo text($check_res['ptsign3']);?>"/>
                                    <img src='' class="img" id="img_ptsign3" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign3" class="form-control" value="<?php echo text($check_res['ptsign3']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 

                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Day 2 Suboxone 4mg SL BID and <b>6mg SL at 1230</b> Date:</label> <label><input type="date" name="date2" style="width:88%;" value="<?php echo text($check_res['date2']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td> 
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign4" id="ptsign4" style="width:60%;" value="<?php echo text($check_res['ptsign4']);?>"/>
                                    <img src='' class="img" id="img_ptsign4" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign4" class="form-control" value="<?php echo text($check_res['ptsign4']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td colspan="2" style="background-color:lightgray;"> 
                                   <p>BEFORE GIVING 1ST DOSE OF SUBOXONE ASSESS LAST USE AND AMOUNT. THEN CALL M.D TO GIVE SUBOXONE.</p>
                                </td>                                
                                                                  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>12.30 PM</b></td>                               
                                <td  style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign5" id="ptsign5" style="width:60%;" value="<?php echo text($check_res['ptsign5']);?>"/>
                                    <img src='' class="img" id="img_ptsign5" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign5" class="form-control" value="<?php echo text($check_res['ptsign5']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>04.00 PM</b></td>                               
                                <td  style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign6" id="ptsign6" style="width:60%;" value="<?php echo text($check_res['ptsign6']);?>"/>
                                    <img src='' class="img" id="img_ptsign6" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign6" class="form-control" value="<?php echo text($check_res['ptsign6']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Day 3 Suboxone 4mg SL TID Date:</label> <label><input type="date" name="date3" style="width:88%;" value="<?php echo text($check_res['date3']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td>
                                <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign7" id="ptsign7" style="width:60%;" value="<?php echo text($check_res['ptsign7']);?>"/>
                                    <img src='' class="img" id="img_ptsign7" style="display:none;width:50%;height:100px;">  
                                    <!-- <input type="text" name="ptsign7" class="form-control" value="<?php echo text($check_res['ptsign7']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                   
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>12.30 PM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign8" id="ptsign8" style="width:60%;" value="<?php echo text($check_res['ptsign8']);?>"/>
                                    <img src='' class="img" id="img_ptsign8" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign8" class="form-control" value="<?php echo text($check_res['ptsign8']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>04.00 PM</b></td>                               
                                <td  style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign9" id="ptsign9" style="width:60%;" value="<?php echo text($check_res['ptsign9']);?>"/>
                                    <img src='' class="img" id="img_ptsign9" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign9" class="form-control" value="<?php echo text($check_res['ptsign9']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Day 4 Suboxone 4mg SL BID and <b>2mg SL at noon</b> Date:</label> <label><input type="date" name="date4" style="width:88%;" value="<?php echo text($check_res['date4']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign10" id="ptsign10" style="width:60%;" value="<?php echo text($check_res['ptsign10']);?>"/>
                                    <img src='' class="img" id="img_ptsign10" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign10" class="form-control" value="<?php echo text($check_res['ptsign10']);?>"/> -->
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                   
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>12.30 PM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>  
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign11" id="ptsign11" style="width:60%;" value="<?php echo text($check_res['ptsign11']);?>"/>
                                    <img src='' class="img" id="img_ptsign11" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign11" class="form-control" value="<?php echo text($check_res['ptsign11']);?>"/> -->
                                </td>                               
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>04.00 PM</b></td>                               
                                <td  style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td>                               
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign12" id="ptsign12" style="width:60%;" value="<?php echo text($check_res['ptsign12']);?>"/>
                                    <img src='' class="img" id="img_ptsign12" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign12" class="form-control" value="<?php echo text($check_res['ptsign12']);?>"/> -->
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Day 5 Suboxone 4mg SL BID Date:</label> <label><input type="date" name="date5" style="width:88%;" value="<?php echo text($check_res['date5']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign13" id="ptsign13" style="width:60%;" value="<?php echo text($check_res['ptsign13']);?>"/>
                                    <img src='' class="img" id="img_ptsign13" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign13" class="form-control" value="<?php echo text($check_res['ptsign13']);?>"/> -->
                                </td>                                   
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>04.00 PM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                    
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign14" id="ptsign14" style="width:60%;" value="<?php echo text($check_res['ptsign14']);?>"/>
                                    <img src='' class="img" id="img_ptsign14" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign14" class="form-control" value="<?php echo text($check_res['ptsign14']);?>"/> -->
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                        </table>    
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label>Order Date:</label>
                                    <input type="date" name="orderdate" value="<?php echo text($check_res['orderdate']);?>"/>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:25%;">
                                    <label>Nurse Transcribing:</label>
                                    <input type="text" name="nurse" value="<?php echo text($check_res['nurse']);?>"/>
                                </td>  
                                <td style="width:25%;">
                                    <label>Patient Sig
                                        nature:</label><i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign" id="ptsign" style="width:60%;" value="<?php echo text($check_res['ptsign']);?>"/>
                                    <img src='' class="img" id="img_ptsign" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign" value="<?php echo text($check_res['ptsign']);?>"/> -->
                                </td>
                                <td style="width:25%;">
                                    <label>Patient Initials:</label>
                                    <input type="text" name="ptinitial" value="<?php echo text($check_res['ptinitial']);?>"/>
                                </td>    
                                <td style="width:25%;"> 
                                    <label><b>Reason Medication Not Given</b></label>
                                    <ol>
                                        <li>Patient Refused</li>
                                        <li>Patient's Condition</li>
                                        <li>Hold Per MD Order</li>
                                    </ol> 
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label>Verifying Nurse:</label>
                                    <input type="text" name="nursever" value="<?php echo text($check_res['nursever']);?>"/>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign" id="nursign" style="width:60%;" value="<?php echo text($check_res['nursign']);?>"/>
                                    <img src='' class="img" id="img_nursign" style="display:none;width:50%;height:100px;">
                                    <!-- <input type="text" name="nursign" value="<?php echo text($check_res['nursign']);?>"/> -->
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial" value="<?php echo text($check_res['nurinitial']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                     
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign1" id="nursign1" style="width:60%;" value="<?php echo text($check_res['nursign1']);?>"/>
                                    <img src='' class="img" id="img_nursign1" style="display:none;width:50%;height:100px;">
                                    <!-- <input type="text" name="nursign1" value="<?php echo text($check_res['nursign1']);?>"/> -->
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial1" value="<?php echo text($check_res['nurinitial1']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                     
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign2" id="nursign2" style="width:60%;" value="<?php echo text($check_res['nursign2']);?>"/>
                                    <img src='' class="img" id="img_nursign2" style="display:none;width:50%;height:100px;">
                                    <!-- <input type="text" name="nursign2" value="<?php echo text($check_res['nursign2']);?>"/> -->
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial2" value="<?php echo text($check_res['nurinitial2']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table class="table table-bordered" style="width:100%;table-layout:fixed;display:table;">
                            <tr>
                                <th style="width: 15%;"><label>Patient Name:</label> 
                                <label><input type="text" style="width:105%;" name="patient1" value="<?php echo text($check_res['patient1']);?>"/></label></th>
                                <th colspan="6" style="text-align:center">DOB: 
                                <input type="date" name="dob1" value="<?php echo text($check_res['dob1']);?>"/></label></th>
                                <th><label>Allergies:</label>
                                <label><input type="text" style="width:105%;" name="allergy1" value="<?php echo text($check_res['allergy1']);?>"/></label>
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <label>Day 6 Suboxone 2mg SL AM and <b>4mg SL PM</b> Date:</label> <label><input type="date" name="date6" style="width:88%;" value="<?php echo text($check_res['date6']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign15" id="ptsign15" style="width:60%;" value="<?php echo text($check_res['ptsign15']);?>"/>
                                    <img src='' class="img" id="img_ptsign15" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign15" class="form-control" value="<?php echo text($check_res['ptsign15']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>04.00 PM</b></td>                               
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign16" id="ptsign16" style="width:60%;" value="<?php echo text($check_res['ptsign16']);?>"/>
                                    <img src='' class="img" id="img_ptsign16" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign16" class="form-control" value="<?php echo text($check_res['ptsign16']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Day 7 Suboxone 2mg SL BID Date:</label> <label><input type="date" name="date7" style="width:88%;" value="<?php echo text($check_res['date7']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                                
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign17" id="ptsign17" style="width:60%;" value="<?php echo text($check_res['ptsign17']);?>"/>
                                    <img src='' class="img" id="img_ptsign17" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign17" class="form-control" value="<?php echo text($check_res['ptsign17']);?>"/> -->
                                </td>
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                        
                                </td>
                                <td><b>04.00 PM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign18" id="ptsign18" style="width:60%;" value="<?php echo text($check_res['ptsign18']);?>"/>
                                    <img src='' class="img" id="img_ptsign18" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign18" class="form-control" value="<?php echo text($check_res['ptsign18']);?>"/> -->
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                
                                </td>                                     
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Day 8 Suboxone 2mg SL in AM Date:</label> <label><input type="date" name="date8" style="width:88%;" value="<?php echo text($check_res['date8']);?>"/></label>
                                </td>
                                <td><b>9.30 AM</b></td>                               
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td style="background-color:lightgray;"> 
                                  
                                </td> 
                                <td> 
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="ptsign19" id="ptsign19" style="width:60%;" value="<?php echo text($check_res['ptsign19']);?>"/>
                                    <img src='' class="img" id="img_ptsign19" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="ptsign19" class="form-control" value="<?php echo text($check_res['ptsign19']);?>"/> -->
                                </td>
                                <td style="background-color:lightgray;"> 
                                   
                                </td>                                
                                <td style="background-color:lightgray;"> 
                                 
                                </td>  
                                <td style="background-color:lightgray;"> 
                                   
                                </td> 
                                <td style="background-color:lightgray;"> 
                                   
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label>Order Date:</label>
                                    <input type="date" name="orderdate1" value="<?php echo text($check_res['orderdate1']);?>"/>
                                </td>  
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:25%;">
                                    <label>Nurse Transcribing:</label>
                                    <input type="text" name="nurse1" value="<?php echo text($check_res['nurse1']);?>"/>
                                </td>  
                                <td style="width:25%;">
                                    <label>Patient Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="patsign" id="patsign" style="width:60%;" value="<?php echo text($check_res['patsign']);?>"/>
                                    <img src='' class="img" id="img_patsign" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="patsign" value="<?php echo text($check_res['patsign']);?>"/> -->
                                </td>
                                <td style="width:25%;">
                                    <label>Patient Initials:</label>
                                    <input type="text" name="patinitial" value="<?php echo text($check_res['patinitial']);?>"/>
                                </td>    
                                <td style="width:25%;"> 
                                    <label><b>Reason Medication Not Given</b></label>
                                    <ol>
                                        <li>Patient Refused</li>
                                        <li>Patient's Condition</li>
                                        <li>Hold Per MD Order</li>
                                    </ol> 
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:100%;">
                                    <label>Verifying Nurse:</label>
                                    <input type="text" name="nursever1" value="<?php echo text($check_res['nursever1']);?>"/>
                                </td>     
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                    
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign3" id="nursign3" style="width:60%;" value="<?php echo text($check_res['nursign3']);?>"/>
                                    <img src='' class="img" id="img_nursign3" style="display:none;width:50%;height:100px;"> 
                                    
                                    <!-- <input type="text" name="nursign3" value="<?php echo text($check_res['nursign3']);?>"/> -->
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial3" value="<?php echo text($check_res['nurinitial3']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                     
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign4" id="nursign4" style="width:60%;" value="<?php echo text($check_res['nursign4']);?>"/>
                                    <img src='' class="img" id="img_nursign4" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="nursign4" value="<?php echo text($check_res['nursign4']);?>"/> -->
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial4" value="<?php echo text($check_res['nurinitial4']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                        <table style="width:100%;"> 
                            <tr>
                                <td style="width:30%;">
                                     
                                </td>  
                                <td style="width:40%;">
                                    <label>Nurse Signature:</label>
                                    <i class="fas fa-pen pen_icon" data-toggle="modal" data-target="#myModal"></i>
                                    <input type="hidden" name="nursign5" id="nursign5" style="width:60%;" value="<?php echo text($check_res['nursign5']);?>"/>
                                    <img src='' class="img" id="img_nursign5" style="display:none;width:50%;height:100px;"> 
                                    <!-- <input type="text" name="nursign5" value="<?php echo text($check_res['nursign5']);?>"/> -->
                                </td>
                                <td style="width:30%;">
                                    <label>Nurse Initials:</label>
                                    <input type="text" name="nurinitial5" value="<?php echo text($check_res['nurinitial5']);?>"/>
                                </td>    
                            </tr>
                        </table>
                        <br/>
                    </div>         
                    <div class="form-group mt-4" style="margin-left: 500px;">
                        <div class="btn-group" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-success btn-save" style=" "><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-danger btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="sig">
                            <img id="view_img" style="display:none" width='380px' height='144px'>
                        </div>
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
        $("#view_img").attr("src", '');
        $("#view_img").css('display','none');
        $('canvas').css('display','block');
        $("#sign_data").val('');
    });



    var id_name, val, display_edit, icon;


      $('.pen_icon').click(function() {
        id_name = $(this).next('input').attr('id');
        var sign_value = $("#"+id_name).val();
        //alert(sign_value);
        if(sign_value!='')
        {
            // $("#sig").css('display','none');
            $('canvas').css('display','none');
            $("#view_img").css('display','block');
            $("#view_img").attr("src", sign_value);
            $("#sign_data").val(sign_value);

        }
        // else{
        //     $("#)
        // }
    });

    $('#add_sign').click(function() {
        var sign = $('#sign_data').val();
        $('#' + id_name).val(sign);
        if(sign!='')
        {
            $("#img_"+id_name).attr('src',sign);
            $("#img_"+id_name).css('display','block');
        }
        else{
            $("#img_"+id_name).css('display','none');
        }

        $('#sign_data').val('');
        sig.signature('clear');
       // $("#sign_data").val('');
       // check_sign();
    });

    $('.radio_change').on('change',function(){
        var checkbox_class= $(this).attr('data-id');
        if($(this).is(":checked"))
        {
            $('.'+checkbox_class).prop('checked',false);
            $(this).prop('checked',true);
            // $('#'+checkbox_class).val($(this).val());
        }
    })

    $(document).ready(function() {

        check_sign();

    })

    function check_sign() {

        $(".pen_icon").each(function() {

            var id_name1 = $(this).next('input').attr('id');
            var sign_value = $("#"+id_name1).val();

            if(sign_value!='')
            {
                $("#img_"+id_name1).css('display','block');
                $("#img_"+id_name1).attr('src',sign_value);

            }

        });

    }
</script>
</html>
