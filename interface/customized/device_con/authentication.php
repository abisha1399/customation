<?php
require_once("../../globals.php");
require_once("$srcdir/lists.inc");
require_once("$srcdir/forms.inc");
require_once("$srcdir/patient.inc");

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Common\Twig\TwigContainer;
use OpenEMR\Core\Header;
use OpenEMR\Events\PatientReport\PatientReportEvent;
use OpenEMR\Menu\PatientMenuRole;
use OpenEMR\OeUI\OemrUI;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

if (!AclMain::aclCheckCore('patients', 'pat_rep')) {
    echo (new TwigContainer(null, $GLOBALS['kernel']))->getTwig()->render('core/unauthorized.html.twig', ['pageTitle' => xl("Terra App")]);
    exit;
}

/**
 * @var EventDispatcherInterface $eventDispatcher  The event dispatcher / listener object
 */
$eventDispatcher = $GLOBALS['kernel']->getEventDispatcher();
?>
<!DOCTYPE>
<html>
<head>
<title><?php echo xlt("Terra App"); ?></title>

<?php Header::setupHeader(['datetime-picker', 'common']); ?>

<?php
$arrOeUiSettings = array(
    'heading_title' => xl('Terra APPs'),
    'include_patient_name' => true,
    'expandable' => false,
    'expandable_files' => array(),//all file names need suffix _xpd
    'action' => "",//conceal, reveal, search, reset, link or back
    'action_title' => "",
    'action_href' => "",//only for actions - reset, link or back
    'show_help_icon' => true
);
$oemr_ui = new OemrUI($arrOeUiSettings);
$pid=isset($_SESSION['pid'])?$_SESSION['pid']:'';
$sql_data = sqlQuery("SELECT * FROM terra_user WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
?>
</head>

<body>
    <div id="container_div" class="<?php echo $oemr_ui->oeContainer();?> mt-3">
        <div id="terra_app"> <!-- large outer DIV -->
            <div class="row">
                <div class="col-sm-12">
                    <?php require_once("$include_root/patient_file/summary/dashboard_header.php");?>
                </div>
            </div>
            <?php
            $list_id = "report"; // to indicate nav item is active, count and give correct id
            // Collect the patient menu then build it
            $menuPatient = new PatientMenuRole();
            $menuPatient->displayHorizNavBarMenu();
            ?>
            <div class="mt-3">
            <?php if(isset($sql_data['status']) && $sql_data['status']==1){  ?>
                <button type="button" class="btn btn-primary btn-sm" value="<?php echo xla('FREESTYLELIBRE'); ?>" ><?php echo xlt('FREESTYLELIBRE'); ?> <span class="badge badge-success" style="display:inline"><i class="fa fa-check" style="font-size:15px;color:white"></i></span></button>
            <?php }elseif(isset($sql_data['status']) && $sql_data['status']==0){?>
                <button type="button" class="myapp btn btn-primary btn-sm" value="<?php echo xla('FREESTYLELIBRE'); ?>" ><?php echo xlt('FREESTYLELIBRE'); ?><span class="badge badge-danger" style="display:inline"> <i class="fa fa-close" style="font-size:15px;color:white"></i></span></button>
                <button type="button" class="myapp btn btn-primary btn-sm" value="<?php echo xla('GOOGLEFIT'); ?>" ><?php echo xlt('GOOGLEFIT'); ?></button>
                <?php }else{ ?>
                <button type="button" class="myapp btn btn-primary btn-sm" value="<?php echo xla('FREESTYLELIBRE'); ?>" ><?php echo xlt('FREESTYLELIBRE'); ?></button>

                <?php } ?>    
        </div>
            <div class="mt-3">
            <p id="verify_done">Once Authentication done<a href="#"> Click here</a></p>
            <p id="msg"></p>
            </div>
        </div>
    </div>
<script>
$(function () {
$("#verify_done").hide();
$(".myapp").click(function() {
// alert(2);
$.ajax({
  "async": true,
  "crossDomain": true,
  "url": "token.php",
  "method": "GET",
  success: function(response) 
   {
    //var data =response.
    var data = $.parseJSON(response);
    var auth_url=data.auth_url;
    // location.href=auth_url;
    // document.getElementById("frame").src = auth_url;
    window.open(auth_url,'_blank');
    $("#verify_done").show();
    console.log(auth_url);

   }
  }); 


}); 
$("#verify_done").click(function() {
// alert(2);
$.ajax({
  "async": true,
  "crossDomain": true,
  "url": "token.php?user_state=verify_user",
  "method": "GET",
  success: function(response) 
   {
   // var msg=response;
    if(response==1){
      user_auth="Successfully Connected";
      $("#msg").html(user_auth);
      $("#msg").css("color", "green");
      alert("Successfully Connected");
      $.ajax({
    "async": true,
    "crossDomain": true,
    "url": "../../forms/vitals/tryterra/getdata.php",
    "method": "GET",
    success: function(response) 
    {
        console.log(response);
    }
    });
    }else{
     user_auth="User has not completed authentication";
     $("#msg").html(user_auth);
     $("#msg").css("color", "red");
    alert("User has not completed authentication");
   }
    console.log(response);
   }
  }); 


}); 
  
});
</script>