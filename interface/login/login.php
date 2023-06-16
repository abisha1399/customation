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
 * @copyright Copyright (c) 2021-2023 Robert Down <robertdown@live.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

// prevent UI redressing
Header("X-Frame-Options: DENY");
Header("Content-Security-Policy: frame-ancestors 'none'");

use OpenEMR\Common\Twig\TwigContainer;
use OpenEMR\Events\Core\TemplatePageEvent;
use OpenEMR\Services\FacilityService;
use OpenEMR\Services\LogoService;
use Symfony\Component\EventDispatcher\EventDispatcher;
use OpenEMR\Core\Header;

$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once("../globals.php");
if(isset($_COOKIE['rememberme'])&&$_COOKIE['rememberme']=='on'&&isset($GLOBALS['enable_keepmesign'])&&$GLOBALS['enable_keepmesign']==true){
    session_start();
    header('Location: ' . $web_root . "/interface/customized/main.php");
    exit();
}
$twig = new TwigContainer(null, $GLOBALS["kernel"]);
$t = $twig->getTwig();

$logoService = new LogoService();
$primaryLogo = $logoService->getLogo("core/login/primary");
$secondaryLogo = $logoService->getLogo("core/login/secondary");
$smallLogoOne = $logoService->getLogo("core/login/small_logo_1");
$smallLogoTwo = $logoService->getLogo("core/login/small_logo_2");

$layout = $GLOBALS['login_page_layout'];

// mdsupport - Add 'App' functionality for user interfaces without standard menu and frames
// If this script is called with app parameter, validate it without showing other apps.
//
// Build a list of valid entries
$emr_app = array();
$sql = "SELECT option_id, title,is_default FROM list_options WHERE list_id=? and activity=1 ORDER BY seq, option_id";
$rs = sqlStatement($sql, ['apps']);
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


function getDefaultLanguage(): array
{
    $sql = "SELECT * FROM lang_languages where lang_description = ?";
    $res = sqlStatement($sql, [$GLOBALS['language_default']]);
    $langs = [];

    while ($row = sqlFetchArray($res)) {
        $langs[] = $row;
    }

    $id = 1;
    $desc = "English";

    if (count($langs) == 1) {
        $id = $langs[0]["lang_id"];
        $desc = $langs[0]["lang_description"];
    }

    return ["id" => $id, "language" => $desc];
}

function getLanguagesList(): array
{
    $mainLangID = empty($_SESSION['language_choice']) ? '1' : $_SESSION['language_choice'];
    $sql = "SELECT ll.lang_id, IF(LENGTH(ld.definition), ld.definition, ll.lang_description) AS trans_lang_description, ll.lang_description
        FROM lang_languages AS ll
        LEFT JOIN lang_constants AS lc ON lc.constant_name = ll.lang_description
        LEFT JOIN lang_definitions AS ld ON ld.cons_id = lc.cons_id AND ld.lang_id = ?
        ORDER BY IF(LENGTH(ld.definition),ld.definition,ll.lang_description), ll.lang_id";
    $res = sqlStatement($sql, [$mainLangID]);
    $langList = [];

    while ($row = sqlFetchArray($res)) {
        $langList[] = $row;
    }

    return $langList;
}

$facilities = [];
$facilitySelected = false;
if ($GLOBALS['login_into_facility']) {
    $facilityService = new FacilityService();
    $facilities = $facilityService->getAllFacility();
    $facilitySelected = ($GLOBALS['set_facility_cookie'] && isset($_COOKIE['pc_facility'])) ? $_COOKIE['pc_facility'] : null;
}
$location_facilities = $facilityService->getAllFacility();
$defaultLanguage = getDefaultLanguage();
$languageList = getLanguagesList();
$_SESSION['language_choice'] = $defaultLanguage['id'];

$relogin = (isset($_SESSION['relogin']) && ($_SESSION['relogin'] == 1)) ? true : false;
if ($relogin) {
    unset($_SESSION["relogin"]);
}

$t1 = $GLOBALS['tiny_logo_1'];
$t2 = $GLOBALS['tiny_logo_2'];
$displaySmallLogo = false;
if ($t1 && !$t2) {
    $displaySmallLogo = 1;
} if ($t2 && !$t1) {
    $displaySmallLogo = 2;
} if ($t1 && $t2) {
    $displaySmallLogo = 3;
}

$regTranslations = json_encode(array(
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
));

$cookie = '';
if (session_name()) {
    $sid = urlencode(session_id());
    $sname = urlencode(session_name());
    $scparams = session_get_cookie_params();
    $domain = $scparams['domain'];
    $path = $scparams['path'];
    $oldDate = gmdate('Y', strtotime("-1 years"));
    $expires = gmdate(DATE_RFC1123, $oldDate);
    $sameSite = empty($scparams['samesite']) ? '' : $scparams['samesite'];
    $cookie = "{$sname}={$sid}; path={$path}; domain={$domain}; expires={$expires}";

    if ($sameSite) {
        $cookie .= "; SameSite={$sameSite}";
    }

    $cookie = json_encode($cookie);
}

$viewArgs = [
    'title' => $openemr_name,
    'displayLanguage' => ($GLOBALS["language_menu_login"] && (count($languageList) != 1)) ? true : false,
    'defaultLangID' => $defaultLanguage['id'],
    'defaultLangName' => $defaultLanguage['language'],
    'languageList' => $languageList,
    'relogin' => $relogin,
    'loginFail' => (isset($_SESSION["loginfailure"]) && $_SESSION["loginfailure"] == 1) ? true : false,
    'displayFacilities' => ($GLOBALS["login_into_facility"]) ? true : false,
    'facilityList' => $facilities,
    'location_facilities'=>$location_facilities,
    'facilitySelected' => $facilitySelected,
    'displayGoogleSignin' => (!empty($GLOBALS['google_signin_enabled']) && !empty($GLOBALS['google_signin_client_id'])) ? true : false,
    'googleSigninClientID' => $GLOBALS['google_signin_client_id'],
    'displaySmallLogo' => $displaySmallLogo,
    'smallLogoOne' => $smallLogoOne,
    'smallLogoTwo' => $smallLogoTwo,
    'displayTagline' => $GLOBALS['show_tagline_on_login'],
    'tagline' => $GLOBALS['login_tagline_text'],
    'displayAck' => $GLOBALS['display_acknowledgements_on_login'],
    'hasSession' => (session_name()) ? true : false,
    'cookieText' => $cookie,
    'regTranslations' => $regTranslations,
    'regConstants' => json_encode(['webroot' => $GLOBALS['webroot']]),
    'siteID' => $_SESSION['site_id'],
    'showLabels' => $GLOBALS['show_labels_on_login_form'],
    'primaryLogo'   => $primaryLogo,
    'displaySecondaryLogo' => $GLOBALS['extra_logo_login'],
    'secondaryLogo' => $secondaryLogo,
    'secondaryLogoPosition' => $GLOBALS['secondary_logo_position'],
    'enable_location_login'=>$GLOBALS['enable_location_login'],
    'enable_keepmesign'=>$GLOBALS['enable_keepmesign'],
    'enable_forgetpassword'=>$GLOBALS['enable_forgetpassword'],
];

/**
 * @var EventDispatcher;
 */
$ed = $GLOBALS['kernel']->getEventDispatcher();

$templatePageEvent = new TemplatePageEvent('login/login.php', [], $layout, $viewArgs);
$event = $ed->dispatch($templatePageEvent, TemplatePageEvent::RENDER_EVENT);
if(isset($GLOBALS['enable_newloginpage'])&&$GLOBALS['enable_newloginpage']==true){
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


        input[type=text],
        input[type=password],
        input[type=text]:active,
        input[type=password]:active {
            width: 415px !important;
            height: 40px !important;
            border-radius: 3px !important;
            border: solid 1px #e1e1e1 !important;
            background-color: #ffffff !important;
            box-shadow: none !important;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px !important;
            font-size: 14px !important;
            line-height: 1.42857143 !important;
            color: #555 !important;
            background-color: #fff !important;
            background-image: none !important;
            border: 1px solid #ccc !important;
            border-radius: 4px !important;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075) !important;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075) !important;
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s !important;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s !important;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s !important;
        }

        .login-btn-custom {
            width:  418px !important;
            height: 40px !important;
            border-radius: 3px !important;
            /* background-color: #27b388 !important; */
            padding: 0px;
            color: #ffffff !important;
            margin-left:-28px;
        }

        .login-btn-custom:hover {
            box-shadow: 0 0 3px #72e8c4 !important;
            outline: 0px;
            transition: .2s linear all;
            color: #ffffff !important;
            /* border-color: #43c39c !important;
            background-color: #1ace9b !important; */
        }

        .image-caption {
            background: rgba(0, 0, 0, .6);
            position: absolute;
            bottom: 0px;
            width: 100%;
            padding: 6px 0px !important;
            color: #fff;
            text-align: center;
            font-size: 16px;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
            background-color: #ffffff !important;
        }

        .features {

            list-style-type: none;

            text-transform: capitalize;
            font-size: 12px;
            letter-spacing: 1.2px;
            font-weight: 550;
            margin-left: 5%;
        }

        ul.features li {
            padding: 8px 0;
            -webkit-transition: .3s all ease;
            -moz-transition: .3s all ease;
            transition: .3s all ease;
            color: white;
            font-weight: 900;
        }

        .features li a {
            color: #fff;
            text-decoration: none;
        }

        .righttitle {
            color: white;
            margin-top: 0px !important;
            padding: 30px 0px 5px 0px;
            margin-left: 12%;
            font-weight: 700;

        }

        .login-panel-promo {
            margin-left: -31px;
        }

        .head-line {
            padding-bottom: 9px;
            margin: 40px 0 20px;
            border-bottom: 1px solid #eee;
        }

        /* .login-bg {
            background-color: #f5f5f5;
        } */

        .login-inline-alignment {
            min-height: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            margin-top: 20px;
            /* align-items: center; */
        }

        .logo-font {
            font-size: 65%;
            font-weight: 400;
            color: #777;
        }

        .input-placeholder {
            font-family: PoppinsLight, sans-serif !important;
            font-weight: 600 !important;
        }

        @media screen and (max-width:450px) {

            .mob-portal-login {
                width: 100% !important;
            }

            .login-panel-promo {
                margin-left: 0px !important;
            }

            .portal-form-align {
                max-width: 80% !important;
            }

            .well-portal {
                padding: 0px !important;
            }

            .portal-flex {
                display: flex !important;
            }
        }


        @media (max-width: 767px) {
            .login-panel-promo {
                margin-left: 0px !important;
                margin-top: -25px;
                margin-bottom: 45px;
            }

            .righttitle {
                color: white;
                margin-top: 0px !important;
                padding: 30px 0px 5px 0px;
                margin-left: 10% !important;
                font-weight: 700;
            }
        }

        input[type=text]:focus,
        input[type=password]:focus {
            font-family: PoppinsLight, sans-serif;
            background: #ffffff !important;
            border-color: #97b0ce !important;
            box-shadow: 0 0 5px #6698d2cc !important;
            outline: 0px;
            transition: .2s linear all;
        }

        input#reg {
            background: #FF9F45 !important;
        }
        .align{
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <br><br><br>


        <div class="row">
            <div class="col-sm-7">
                <div>
                    <?php

                    if ($GLOBALS['login_into_facility']) {
                        $facilityService = new FacilityService();
                        $facilities = $facilityService->getAll();
                        $facilitySelected = ($GLOBALS['set_facility_cookie'] && isset($_COOKIE['pc_facility'])) ? $_COOKIE['pc_facility'] : null;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <?php if (isset($_SESSION['relogin']) && ($_SESSION['relogin'] == 1)) : // Begin relogin dialog 
                ?>
                    <div class="alert alert-info m-1">
                        <strong>
                            <?php echo xlt('Password security has recently been upgraded.') . '&nbsp;&nbsp;' . xlt('Please login again.'); ?>
                        </strong>
                    </div>
                <?php unset($_SESSION['relogin']);
                endif;
                if(isset($_GET['success'])){
                    $_SESSION['loginfailure']='0';
                }
                if (isset($_SESSION['loginfailure']) && ($_SESSION['loginfailure'] == 1)) : // Begin login failure block
                ?>
                    <div class="alert alert-danger login-failure m-1">
                        <?php echo xlt('Invalid username or password'); ?>
                    </div>
                <?php endif; // End login failure block
                
                if (isset($_GET['success'])) : // Begin login failure block
                ?>
                    <div class="alert alert-success login-failure m-1">
                        <?php echo xlt('Password changed successfully..'); ?>
                    </div>
                <?php endif; // End login failure block
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 mob-portal-login login-bg">
               
                <div class="well field-container well-portal mt-5">
                    <div class="login-inline-alignment">

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


                            <div class="form-group required portal-flex " style=" margin-top: 0px;">
                                <img src="../customized/image/capmind-logo.png" alt="refresh" height='25' class="align" style="margin-left: -10px;"/>
                            </div>
                            <br/>
                            <div class="form-group required portal-flex" style=" margin-top: 0px;    margin-top: 0px;display:flex;">
                                <h3 class="text-dark"><b>Hi, Welcome back !</b></h3>
                            </div>
                            <div class="form-group required portal-flex" style="margin: 0; margin-top: 0px;">
                                <label for="authUser" class="text-dark"
                                 style="display:flex;">Username</label>
                                <input type="text" class="form-control input-custom input-placeholder" id="authUser" class="form-control" name="authUser" placeholder="<?php echo xla('Enter your Username'); ?>"  value="<?php echo isset($_COOKIE['authUser'])?$_COOKIE['authUser']:''; ?>">
                            </div>
                            <div class="form-group required portal-flex" style="margin: 0; margin-top: 15px;">
                            <label for="authUser" class="text-dark"
                                 style="display:flex;">Password</label>
                                <input type="password" class="form-control input-custom input-placeholder" id="clearPass" name="clearPass" placeholder="<?php echo xla('Enter your password'); ?>" value="<?php echo isset($_COOKIE['password'])?$_COOKIE['password']:'' ?>">
                            </div>
                            <?php
                            if(isset($GLOBALS['enable_location_login'])&&$GLOBALS['enable_location_login']==true)
                            {
                            ?>
                            <div class="form-group required portal-flex" style="margin: 0; margin-top: 15px;">
                            <label for="authUser" class="text-dark" style="display:flex;">Location</label>
                                <select class="form-control input-custom" name="facility_location" style="width: 93% !important">

                                    <?php
                                    $facility=sqlStatement("SELECT name,id FROM facility WHERE service_location=1");
                                

                                        while ($iter2=sqlFetchArray($facility)){
                                            ?>
                                            <option value="<?php echo attr($iter2['id']); ?>"
                                            <?php if ($iter['facility_id'] == $iter2['id']) {
                                                    echo "selected";
                                                            } ?>><?php echo text($iter2['name']); ?></option>
                                            <?php
                                        }
                                
                                        ?>      
                                </select>
                            </div>
                            <?php
                            }
                            ?>

                            <!-- <input type="text" style="margin: 0; margin-top: 5px;" class="form-control input-custom input-placeholder" value="<?php echo attr($_SESSION['site_id']); ?>" name="site" placeholder="<?php echo xla('Practice Id'); ?>"> -->
                            
                            <div class="form-group required portal-flex" style="margin: 0; margin-top: 15px; ">
                            <table>
                                <tr>
                                    <?php 
                                    if(isset($GLOBALS['enable_keepmesign'])&&$GLOBALS['enable_keepmesign']==true){
                                    ?>
                                    <td>
                                     
                                     <input type="checkbox" name="rememberme"  <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>/> Keep me Signed in
                                    </td>                                    
                                    <td></td>
                                    <?php
                                    }
                                    if(isset($GLOBALS['enable_forgetpassword'])&&$GLOBALS['enable_forgetpassword']==true){
                                    ?>
                                    <td>
                                    <a href="../customized/verify_login.php" style="text-decoration:none;margin-top: 15px;font-size:14px;color:#173e58;margin-left: 150px !important;" class="ml-5">Forgot password?</a>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </table>
                            </div>
                            <div style="display: flex; justify-content: center;">
                                <input type="submit" onClick="transmit_form()" value="Login" id="login" class="btn btn-md btn-block btn-primary login-btn-custom" style="margin-top: 35px;" name="sub">
                            </div>

                        </form>

                    </div>
                </div>


            </div>
            <!-- <div class="col-sm-3" >
            </div> -->
            <div class="col-sm-7 mob-portal-login login-panel-promo">
                <div style="position: relative; overflow: hidden">
                    <img src="../customized/image/openemr.jpg" alt="refresh"/>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
    <?php
}
else{
    echo $t->render($event->getTwigTemplate(), $event->getTwigVariables());
}

