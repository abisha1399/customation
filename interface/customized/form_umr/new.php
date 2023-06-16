<?php
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
if ($formid) {
    $sql = "SELECT * FROM `form_umr` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}
// print_r($check_res);
// die();
$check_res = $formid ? $check_res : array();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
            <body style="padding:100px;font-size:17px;font-family:sans-serif;">
    <form method="post" name="my_form" id="my_pat_form" action="<?php echo $rootdir; ?>/forms/form_umr/save.php?id=<?php echo attr_url($formid); ?>">

        <h3 style="text-align:center">APPEALS -DESIGNATION OF AUTHORIZED REPRESENTATIVE</h3>
        <span>I,</span>
        <input style="border:none;border-bottom:2px solid black;width:200px;" type="text" name="fname"  value=" <?php echo text($check_res['fname']);?>"/>
        <span>, do hereby appoint</span>
        <input style="border:none;border-bottom:2px solid black;width:200px;" type="text" name="lname"  value=" <?php echo text($check_res['lname']);?>"/>
        <span>(hereinafter my Authorized Representative") to act on  my behalf  in pursuing  a  benefit claim, specifically, claim(s) foe XX.  My Authorized representative shall have full authority to act, and receive notices, on my behalf with respect to an initial determination of the claim,
            any request for documents relating to the claim, any appeal of  an  adverse  benefit determination of the claim and any request for external review/IRO of the claim if
            applicable.
            </span>
            <div contentEditable="true" class="text_edit"><?php 
         echo $check_res['text1']??'
        <p>I understand that in the absence of a contrary direction from me, UJMR will  direct  all information and notices regarding the claim to which I otherwise an entitled, including benefit determinations, to my Authorized representative only.
        </p>
        <p>I am aware that the Standards for Privacy of Individually Identifiable Health Information set forth by the U.S. Department of Health and Human Services (the "Privacy Standards") govern  access  to  medical  information.  I   under-stand   that   in   connection   with   the performance of his/her duties hereunder, my Authorized Representative may receive my Protected Health Information, as defined in the Privacy Standards, relating to the claim.  I hereby consent to any disclosure of my Protected Health Information to my Authorized representative</p>';?>
        </div><input type="hidden" name="text1" id="text1">

            <div style="display: inline-block; width:500px;margin-bottom:20px;" >
                <input style="border:none;border-bottom:1px solid black;" type="date"  name="date1"  value="<?php echo text($check_res['date1']);?>" /><br>
                <label>Date</label>
                </div>
                <div style="display: inline-block; width:500px;margin-bottom:20px;" >
                    <input style="border:none;border-bottom:1px solid black;width:300px" type="text"  name="signature1"  value=" <?php echo text($check_res['signature1']);?>" ><br>
                    <label>(Signature of patient or patient's guardian)</label>
                    </div>
                    <h3 style="text-align: center;">ACKNOWLEDGEMENT</h3>
                    <span>I,</span>
                    <input style="border:none;border-bottom:2px solid black;width:200px;" type="text" name="ack1" value=" <?php echo text($check_res['ack']);?>"/>
                    <span>have read the above Designation of Authorized Representative and I hereby accept this Designation and agree to act as Authorized Representaive for XX with respect to the above defined claim.</span><p></p>
                    <div style="display: inline-block; width:500px;margin-bottom:20px;" >
                        <input style="border:none;border-bottom:1px solid black;" type="date"  name="date2" value="<?php echo text($check_res['date2']);?>"/><br>
                        <label>Date</label>
                        </div>
                        <div style="display: inline-block; width:500px;margin-bottom:20px;" >
                            <input style="border:none;border-bottom:1px solid black;width:300px" type="text"  name="signature2" value=" <?php echo text($check_res['signature2']);?>" ><br>
                            <label>(Signature of Authorized Representaive)</label>
                            </div>
                            <p>Notices may sent to the Authorized Representaive at the following Address:</p>
                            <span>Name:</span>
        <input style="border:none;border-bottom:2px solid black;width:900px;" type="text" name="Nname" value=" <?php echo text($check_res['Nname']);?>"/><p></p>
        <span>Street Address:</span>
        <input style="border:none;border-bottom:2px solid black;width:900px;" type="text" name="Naddress" value=" <?php echo text($check_res['Naddress']);?>"/><p></p>
        <span>City,State&Zipcode:</span>
        <input style="border:none;border-bottom:2px solid black;width:900px;" type="text" name="Ncity" value=" <?php echo text($check_res['Ncity']);?>"/><p></p>
        <span>Phone Number:</span>
        <input style="border:none;border-bottom:2px solid black;width:900px;" type="number" name="Nnumber" value="<?php echo text($check_res['Nnumber']);?>"/><p></p>
</div>
<input style=" border:1px solid blue;margin-left:470px;padding:10px;background-color:blue;color:white;font-size:16px;" type="submit" name="sub" id="btn-save" value="Submit" >
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
           alert( $(this).next("input").val());
            
        });
        $errocount = 0;
        if($errocount==0)
        {
            $('#my_pat_form').submit();

        }
    });
    </script>
</html>