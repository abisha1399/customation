<?php

/**
 *
 * Modified from interface/main/calendar/add_edit_event.php for
 * the patient portal.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (C) 2005-2006 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (C) 2016-2019 Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

// Will start the (patient) portal OpenEMR session/cookie.
require_once(dirname(__FILE__) . "/../../src/Common/Session/SessionUtil.php");
OpenEMR\Common\Session\SessionUtil::portalSessionStart();

$isPortal = false;
if (isset($_SESSION['pid']) && isset($_SESSION['patient_portal_onsite_two'])) {
    $pid = $_SESSION['pid'];
    $ignoreAuth_onsite_portal = true;
    $isPortal = true;
    require_once(dirname(__FILE__) . "/../globals.php");
} else {
    OpenEMR\Common\Session\SessionUtil::portalSessionCookieDestroy();
    $ignoreAuth = false;
    require_once(dirname(__FILE__) . "/../globals.php");
    if (!isset($_SESSION['authUserID'])) {
        $landingpage = "index.php";
        header('Location: ' . $landingpage);
        exit();
    }
}
require_once("$srcdir/patient.inc");
require_once("$srcdir/payment.inc.php");


use OpenEMR\Billing\BillingUtilities;
use OpenEMR\Common\Crypto\CryptoGen;

$cryptoGen = new CryptoGen();

use OpenEMR\Core\Header;

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo xlt("payment popup"); ?></title>
    <?php // no header necessary. scope is home.php ?>
    <?php Header::setupHeader(['no_main-theme', 'datetime-picker', 'opener']); ?>
    <!-- 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
  <script src="https://js.stripe.com/v3/"></script>
    <script>
          var publicKey1 = <?php echo json_encode($cryptoGen->decryptStandard($GLOBALS['gateway_public_key'])); ?>;
        var apiKey1 = <?php echo json_encode($cryptoGen->decryptStandard($GLOBALS['gateway_api_key'])); ?>;
        
        </script>
         <script src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-creditcardvalidator/jquery.creditCardValidator.js"></script>
    <script src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js?v=<?php echo $v_js_includes; ?>"></script>
    
  <script>
        var chargeMsg = <?php $amsg = xl('Payment was successfully authorized and your card is charged.') . "\n" .
                xl("You will be notified when your payment is applied for this invoice.") . "\n" .
                xl('Until then you will continue to see payment details here.') . "\n" . xl('Thank You.');
            echo json_encode($amsg);
        ?>;
        function setpaystatus(status) {
    opener.setpaystatus(status);
    dlgclose();
    return false;
}
         </script>
</head>

<body class="skin-blue">
    <div class="container">
<form method="post" name="payment-form" id="payment-form">
                            <fieldset>
                                <div class="form-group">
                                    <label label-default="label-default"><?php echo xlt('Name on Card'); ?></label>
                                    <div class="controls">
                                        <input name="cardHolderName" id="cardHolderName" type="text" class="form-control" pattern="\w+ \w+.*" title="<?php echo xla('Fill your first and last name'); ?>" value="<?php echo attr($patdata['fname']) . ' ' . attr($patdata['lname']) ?>" />
                                    </div>
                                </div>
                                <div class="form-row form-group">
                                    <label for="card-element"><?php echo xlt('Credit or Debit Card') ?></label>
                                    <div id="card-element" style="width: 100%;"></div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                                <div class="col-md-6">
                                    <h4 style="display: inline-block;"><?php echo xlt('Payment Amount'); ?>:&nbsp;
                                        <strong><span id="payTotal"></span></strong></h4>
                                </div>
                                <input type='hidden' name='form_pid' id="patient_id"> 
                                <input type='hidden' name='form_apt' id='form_apt' value='1'/>
                                <input type='hidden' name='mode' id='mode' value=''/>
                                <input type='hidden' name='cc_type' id='cc_type' value=''/>
                                <input type='hidden' name='payment' id='paymentAmount' value=''/>
                                <input type='hidden' name='invValues' id='invValues' value=''/>
                                
                            </fieldset>
                        </form>

                        <button id="stripeSubmit" class="btn btn-primary"><?php echo xlt('Pay Now'); ?></button>
</div>
                        <?php
                         if ($GLOBALS['payment_gateway'] == 'Stripe') { ?>
                           
                                                <?php } ?>
<?php if ($GLOBALS['payment_gateway'] == 'Stripe') { // Begin Include Stripe ?>
        <script>
            const stripe1 = Stripe(publicKey1);
            const elements1 = stripe1.elements();// Custom styling can be passed to options when creating an Element.
            const style1 = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", "Helvetica", sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aaa8a8'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }

            };
            // Create an instance of the card Element.
            const card1 = elements1.create('card', {style: style1});
            // Add an instance of the card Element into the `card-element` <div>.
            card1.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card1.addEventListener('change', function (event) {
                let displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            let total = <?php echo $_REQUEST['payamount']; ?>;          
                   
            $("#payTotal").text(total);
            $("#paymentAmount").val(total);
            $("#patient_id").val(<?php echo $_REQUEST['form_pid'];?>);
           
            // Handle form submission.
            let form1 = document.getElementById('stripeSubmit');
            form1.addEventListener('click', function (event) {
                event.preventDefault();
              
                stripe1.createToken(card1).then(function (result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        let errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to server.
                        stripeTokenHandler(result.token);
                    }
                });
            });
           
            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                let oForm = document.forms['payment-form'];
                oForm.elements['mode'].value = "Stripe";

                // let inv_values = JSON.stringify(getFormObj('invoiceForm'));
                // document.getElementById("invValues").value = inv_values;

                let hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                oForm.appendChild(hiddenInput);

                // Submit payment to server
                fetch('../../portal/lib/paylib.php', {
                    method: 'POST',
                    body: new FormData(oForm)
                }).then(function(response) {
                    if (!response.ok) {
                        throw Error(response.statusText);
                    }
                    return response.text();
                }).then(function(data) {
                    if(data !== 'ok') {
                        alert(data);
                        
                        return;
                    }
                    alert(chargeMsg);
                    setpaystatus(data);
                    window.location.reload(false);
                }).catch(function(error) {
                    alert(error)
                });
            }
        </script>
    <?php } ?>

</body>
</html>
