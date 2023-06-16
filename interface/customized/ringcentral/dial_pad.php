<?php

$ignoreAuth = 1;
include_once("../../globals.php");

//require_once("../rc_fax/libs/controller/ClientAppController.php");

// use OpenEMR\Core\Header;
// $username='+14046001575';
// $password='Connectedcare1!';
// $extensionNum='101';

// kick off app endpoints controller
// $clientApp = new clientController();
// $response=$clientApp->opendialpad();
// echo '<pre>';print_r($response);
// PROCESS RESPONSE
?>
<html>
    <body>
        <div id="script">
</div>
</body>
<!-- <script src="https://ringcentral.github.io/ringcentral-embeddable-voice/adapter.js"></script> -->

<script>
(function() {
  console.warn('this uri is deprecated. Please stop use it soon before the feature is completely removed. Please use new uri: https://ringcentral.github.io/ringcentral-embeddable/adapter.js');
  var currentScript = document.currentScript;
  
  if (!currentScript) {
    currentScript = document.querySelector('script[src*="adapter.js"]');
  }
  if (currentScript && currentScript.src) {
    currentScript = currentScript.src;
    currentScript = currentScript.replace('ringcentral-embeddable-voice', 'ringcentral-embeddable');
  } else {
    currentScript = "https://ringcentral.github.io/ringcentral-embeddable/adapter.js";
  }
  if (currentScript.indexOf('redirectUri') === -1) {
    // To keep using old redirect uri on old embeddable voice adapter.js
    if (currentScript.indexOf('?') > -1) {
      currentScript = currentScript + '&redirectUri=' + encodeURIComponent('https://ringcentral.github.io/ringcentral-embeddable-voice/redirect.html');
    } else {
      currentScript = currentScript + '?redirectUri=' + encodeURIComponent('https://ringcentral.github.io/ringcentral-embeddable-voice/redirect.html');
    }
  }
  
  var rc_s = document.createElement("script");
  rc_s.src = currentScript;
  var rc_s0 = document.getElementsByTagName("script")[0];  
  rc_s0.parentNode.insertBefore(rc_s, rc_s0);
 
  
 
 
})();
<?php
$phone=isset($_GET['phone'])&&$_GET['phone']!=''? $_GET['phone']:'';
?>
var phone='<?php echo $phone;?>';
// alert(phone);
if(phone!='undefined'){
  setTimeout(function()
  { 
        
        document.querySelector("#rc-widget-adapter-frame").contentWindow.postMessage({
        type: 'rc-adapter-new-call',
        phoneNumber: ``+phone+``,
        toCall: false,
        }, '*');

        //         document.querySelector("#rc-widget-adapter-frame").contentWindow.postMessage({
        //   type: 'rc-adapter-new-sms',
        //   phoneNumber: ``+phone+``,
        //   text: `hlo test message`,
        // }, '*');
  }, 5000);
}



</script>   
<script>
  
  </script>
</html>

