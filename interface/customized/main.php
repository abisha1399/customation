

<!-- <form method="POST" id="login_form" autocomplete="off" class="portal-form-align" action="../main/main_screen.php?auth=login&site=<?php echo $_SESSION['site_id']; ?>" target="_top" name="login_form">
<input type="hidden" class="form-control input-custom input-placeholder" id="authUser" class="form-control" name="authUser" value="<?php echo $_COOKIE['authUser']; ?>">
<input type="hidden" class="form-control input-custom input-placeholder" id="clearPass" name="clearPass"  value="<?php echo $_COOKIE['password'] ?>">
<input type="hidden" id="login">
</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
    $(window).on('load',function(){
        var cookie='<?php echo  $_COOKIE['rememberme']?>';
        if(cookie=='on'){
            jQuery('#login').click();
        }
    });
</script>     -->

<?php

/**
 * Login screen.
 *
 * @package OpenEMR
 * @link    http://www.open-emr.org
 * @author  Rod Roark <rod@sunsetsystems.com>
 * @author  Brady Miller <brady.g.miller@gmail.com>
 * @author  Kevin Yeh <kevin.y@integralemr.com>
 * @author  Scott Wakefield <scott.wakefield@gmail.com>
 * @author  ViCarePlus <visolve_emr@visolve.com>
 * @author  Julia Longtin <julialongtin@diasp.org>
 * @author  cfapress
 * @author  markleeds
 * @author  Tyler Wrenn <tyler@tylerwrenn.com>
 * @author  Ken Chapple <ken@mi-squared.com>
 * @author  Daniel Pflieger <daniel@mi-squared.com> <daniel@growlingflea.com>
 * @author  Robert Down <robertdown@live.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2020 Tyler Wrenn <tyler@tylerwrenn.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Daniel Pflieger <daniel@mi-squared.com> <daniel@growlingflea.com>
 * @copyright Copyright (c) 2021-2022 Robert Down <robertdown@live.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

use OpenEMR\Core\Header;
use OpenEMR\Services\FacilityService;

$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;

require_once("../globals.php");
// mdsupport - Add 'App' functionality for user interfaces without standard menu and frames
// If this script is called with app parameter, validate it without showing other apps.
//
// Build a list of valid entries
//echo '<pre>';print_r($_COOKIE);exit();
$emr_app = array();
$rs = sqlStatement(
    "SELECT option_id, title,is_default FROM list_options
        WHERE list_id=? and activity=1 ORDER BY seq, option_id",
    array('apps')
);
if (sqlNumRows($rs)) {
    while ($app = sqlFetchArray($rs)) {
        $app_req = explode('?', trim($app['title']));
        if (! file_exists('../' . $app_req[0])) {
            continue;
        }

        $emr_app [trim($app ['option_id'])] = trim($app ['title']);
        if ($app ['is_default']) {
            $emr_app_def = $app ['option_id'];
        }
    }
}

$div_app = '';
if (count($emr_app)) {
    // Standard app must exist
    $std_app = 'main/main_screen.php';
    if (!in_array($std_app, $emr_app)) {
        $emr_app['*OpenEMR'] = $std_app;
    }

    if (isset($_REQUEST['app']) && $emr_app[$_REQUEST['app']]) {
        $div_app = sprintf('<input type="hidden" name="appChoice" value="%s">', attr($_REQUEST['app']));
    } else {
        foreach ($emr_app as $opt_disp => $opt_value) {
            $opt_htm .= sprintf(
                '<option value="%s" %s>%s</option>\n',
                attr($opt_disp),
                ($opt_disp == $opt_default ? 'selected="selected"' : ''),
                text(xl_list_label($opt_disp))
            );
        }

        $div_app = sprintf(
            '
<div id="divApp" class="form-group">
    <label for="appChoice" class="text-right">%s:</label>
    <div>
        <select class="form-control" id="selApp" name="appChoice" size="1">%s</select>
    </div>
</div>',
            xlt('App'),
            $opt_htm
        );
    }
}

// This code allows configurable positioning in the login page
$loginrow = "row login-row align-items-center m-5";

if ($GLOBALS['login_page_layout'] == 'left') {
    $logoarea = "col-md-6 login-bg-left py-3 px-5 py-md-login order-1 order-md-2";
    $formarea = "col-md-6 p-5 login-area-left order-2 order-md-1";
} else if ($GLOBALS['login_page_layout'] == 'right') {
    $logoarea = "col-md-6 login-bg-right py-3 px-5 py-md-login order-1 order-md-1";
    $formarea = "col-md-6 p-5 login-area-right order-2 order-md-2";
} else {
    $logoarea = "col-12 login-bg-center py-3 px-5 order-1";
    $formarea = "col-12 p-5 login-area-center order-2";
    $loginrow = "row login-row login-row-center align-items-center";
}
 
?>
<html>

<head>
    <?php Header::setupHeader(); ?>

    <title><?php echo text($openemr_name) . " " . xlt('Login'); ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var registrationTranslations = <?php echo json_encode(array(
                                            'title' => xla('OpenEMR Product Registration'),
                                            'pleaseProvideValidEmail' => xla('Please provide a valid email address'),
                                            'success' => xla('Success'),
                                            'registeredSuccess' => xla('Your installation of OpenEMR has been registered'),
                                            'submit' => xla('Submit'),
                                            'noThanks' => xla('No Thanks'),
                                            'registeredEmail' => xla('Registered email'),
                                            'registeredId' => xla('Registered id'),
                                            'genericError' => xla('Error. Try again later'),
                                            'closeTooltip' => ''
                                        )); ?>;

        var registrationConstants = <?php echo json_encode(array(
                                        'webroot' => $GLOBALS['webroot']
                                    )); ?>;
    </script>

    <script src="<?php echo $webroot ?>/interface/product_registration/product_registration_service.js?v=<?php echo $v_js_includes; ?>"></script>
    <script src="<?php echo $webroot ?>/interface/product_registration/product_registration_controller.js?v=<?php echo $v_js_includes; ?>"></script>

    <script>
        $(document).ready(function() {
            $('#reg').click(function() {

                window.location.href = '../register/register.php';
                return false;
            });
        });
        $(function() {

            init();

            var productRegistrationController = new ProductRegistrationController();
            productRegistrationController.getProductRegistrationStatus(function(err, data) {
                if (err) {
                    return;
                }

                if (data.statusAsString === 'UNREGISTERED') {
                    productRegistrationController.showProductRegistrationModal();
                }
            });
        });
        $(function() {
            <?php if (isset($_GET['success'])) { ?>
                var unique_id = $.gritter.add({
                    title: '<span class="green">' + <?php echo xlj('Success!'); ?> + '</span>',
                    text: <?php echo xlj('Password changed successfully..'); ?>,
                    sticky: false,
                    time: '5000',
                    class_name: 'my-nonsticky-class'
                });
            <?php } ?>
            <?php if (isset($_GET['failure'])) { ?>
                var unique_id = $.gritter.add({
                    title: '<span class="red">' + <?php echo xlj('Oops!'); ?> + '</span>',
                    text: <?php echo xlj('Something went wrong. Please try again.'); ?>,
                    sticky: false,
                    time: '5000',
                    class_name: 'my-nonsticky-class'
                });
            <?php } ?>
        });

        function init() {
            $("#authUser").focus();

        }

        function transmit_form() {
            <?php if (!empty($GLOBALS['restore_sessions'])) { ?>
                // Delete the session cookie by setting its expiration date in the past.
                // This forces the server to create a new session ID.
                var olddate = new Date();
                olddate.setFullYear(olddate.getFullYear() - 1);
                <?php if (version_compare(phpversion(), '7.3.0', '>=')) { ?>
                    // Using the SameSite setting when using php version 7.3.0 or above, which avoids browser warnings when cookie is not 'secure' and SameSite is not set to anything
                    document.cookie = <?php echo json_encode(urlencode(session_name())); ?> + '=' + <?php echo json_encode(urlencode(session_id())); ?> + '; path=<?php echo ($web_root ? $web_root : '/'); ?>; expires=' + olddate.toGMTString() + '; SameSite=Strict';
                <?php } else { ?>
                    document.cookie = <?php echo json_encode(urlencode(session_name())); ?> + '=' + <?php echo json_encode(urlencode(session_id())); ?> + '; path=<?php echo ($web_root ? $web_root : '/'); ?>; expires=' + olddate.toGMTString();
                <?php } ?>
            <?php } ?>
            document.forms[0].submit();
        }
    </script>
    <style type="text/css">
        @import "../../public/fonts/poppins/PoppinsLight.css";
        #cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
   
}

@-webkit-keyframes spin {
	from {-webkit-transform:rotate(0deg);}
	to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
	from {transform:rotate(0deg);}
	to {transform:rotate(360deg);}
}

#cover-spin::after {
    content:'';
    display:block;
    position:absolute;
    left:48%;top:40%;
    width:40px;height:40px;
    border-style:solid;
    border-color:blue;
    border-top-color:transparent;
    border-width: 4px;
    border-radius:50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}
    </style>
</head>

<body>
    <div class="container">
        <br><br><br>
        <div id="cover-spin">
           
        </div>

        

        <form method="POST" id="login_form" autocomplete="off" class="portal-form-align" action="../main/main_screen.php?auth=login&site=<?php echo attr($_SESSION['site_id']); ?>" target="_top" name="login_form">
                         
                         <input type='hidden' name='new_login_session_management' value='1' />
                         <?php
                         // collect groups
                         $res = sqlStatement("select distinct name from `groups`");
                         for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
                             $result[$iter] = $row;
                         }

                         if (count($result) == 1) {
                             $resvalue = $result[0]["name"];
                             echo "<input type='hidden' name='authProvider' value='" . attr($resvalue) . "' />\n";
                         }

                         // collect default language id
                         echo "<input type='hidden' name='languageChoice' value='1' />\n";
                         ?>

<input type="hidden" class="form-control input-custom input-placeholder" id="authUser" class="form-control" name="authUser" placeholder="<?php echo xla('Enter your email'); ?>"  value="<?php echo $_COOKIE['authUser']; ?>">
<input type="hidden" class="form-control input-custom input-placeholder" id="clearPass" name="clearPass" placeholder="<?php echo xla('Enter your password'); ?>" value="<?php echo $_COOKIE['password'] ?>">
<input type="hidden" onClick="transmit_form()" value="Login" id="login" class="btn btn-md btn-block btn-primary login-btn-custom" style="margin-top: 35px;" name="sub">

                     </form>
    </div>
</body>

</html>
<script>
    $(window).on('load',function(){
        var cookie='<?php echo  $_COOKIE['rememberme']?>';
        if(cookie=='on'){
            jQuery('#login').click();
        }
    });
    $(function(){
        
        // alert(cookie);
    })
    </script>