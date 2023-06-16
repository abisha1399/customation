<?php

/**
 * emailnotification script.
 *
 * @package OpenEMR
 * @author  cfapress
 * @author  Jason 'Toolbox' Oettinger <jason@oettinger.email>
 * @link    http://www.open-emr.org
 * @copyright Copyright (c) 2008 cfapress
 * @copyright Copyright (c) 2017 Jason 'Toolbox' Oettinger <jason@oettinger.email>
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");
require_once("$srcdir/registry.inc");
use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Common\Twig\TwigContainer;
use OpenEMR\Core\Header;


// process form
if (!empty($_GET['email_type']) && ($_GET['email_type'] == 'true')) {
   $result=[];
    //echo '<pre>';print_r($_POST);exit();
    if (empty($_POST['email_sender'])) {
        $form_err .= xl('Empty value in "Email Sender"') . '<br />';
    }

    if (empty($_POST['email_subject'])) {
        $form_err .= xl('Empty value in "Email Subject"') . '<br />';
    }

    if (empty($_POST['message'])) {
        $form_err .= xl('Empty value in "Email Text"') . '<br />';
    }

    // Store the new settings.  sms_gateway_type is not used for email.
    // notification_id is the pk, and should always be 2 for email settings.

    if (!$form_err) {
        $email_data=sqlQuery("SELECT * FROM automatic_notification WHERE notification_type='Ringcentral_email'");
        //echo '<pre>';print_r($email_data);exit();
        $id=isset($email_data['notification_id'])&&$email_data['notification_id']!=''?$email_data['notification_id']:'';        
        if($id){
            sqlStatement("UPDATE automatic_notification SET provider_name=?,message=?,email_sender=?,email_subject=? WHERE notification_id=?",array($_POST['provider_name'],$_POST['message'], $_POST['email_sender'],$_POST['email_subject'],$id));
           
        }
        else{
           $id=sqlInsert("INSERT INTO automatic_notification (provider_name,message,email_sender,email_subject,notification_type,type) VALUES(?, ?, ?, ?, ?,?)",array($_POST['provider_name'],$_POST['message'], $_POST['email_sender'],$_POST['email_subject'],'Ringcentral_email',''));
        }
        if ($id) {
            $sql_msg = xl("Email Settings Updated Successfully");
            $result['status']='success';
            $result['msg']=$sql_msg;;
        }
    }
    else{
        $result['status']='error';
        $result['msg']='please fill all field';
    }
    echo json_encode($result);
    exit();
}


if (!empty($_GET['sms_type']) && ($_GET['sms_type'] == 'true')) {
    $result=[];
     //echo '<pre>';print_r($_POST);exit();
     if (empty($_POST['message'])) {
         $form_err .= xl('Empty value in "Email Text"') . '<br />';
     }
 
     // Store the new settings.  sms_gateway_type is not used for email.
     // notification_id is the pk, and should always be 2 for email settings.
 
     if (!$form_err) {
         $email_data=sqlQuery("SELECT * FROM automatic_notification WHERE notification_type='Ringcentral_sms'");
         //echo '<pre>';print_r($email_data);exit();
         $id=isset($email_data['notification_id'])&&$email_data['notification_id']!=''?$email_data['notification_id']:'';
       
         if($id){
             sqlStatement("UPDATE automatic_notification SET message=? WHERE notification_id=?",array($_POST['message'],$id));
            
         }
         else{
            $id=sqlInsert("INSERT INTO automatic_notification (message,notification_type,type) VALUES(?, ?,?)",array($_POST['message'],'Ringcentral_sms',''));
         }
         if ($id) {
             $sql_msg = xl("SMS Notification Settings Updated Successfully");
             $result['status']='success';
             $result['msg']=$sql_msg;;
         }
     }
     else{
         $result['status']='error';
         $result['msg']='please fill all field';
     }
     echo json_encode($result);
     exit();
 }

// fetch email config from table.  This should never fail, because one row
// of each type is seeded when the db is created.


//my_print_r($result);

//START OUT OUR PAGE....
?>
<html>
<head>
    <?php Header::setupHeader(); ?>
    <title><?php echo xlt("Ringcentral Notification"); ?></title>
</head>
<body class="body_top container">
    <header class="row">
    <nav class="w-100 m-3">
    <ul class="tabNav">
        <li class="nav-item"> <a href="#" class="template" id="Email_template">Email Template  </a></li>
        <li class="nav-item"> <a href="#" class="template" id="sms_template">SMS Template</a></li>
        
    </ul>
</nav>
       
    </header>
    <div class="tabContainer">
        <div class="tab current" id="tab_Email_template">
            <main class="mx-4">
                <form name="select_form" method="post" id="email_my_form" action="">
                    <?php
                    $sql = "select * from automatic_notification where notification_type='Ringcentral_email'";
                    $result = sqlQuery($sql);
                    //echo '<pre>';print_r($result);exit();
                    ?>
                
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="email_sender">Email Sender:</label>
                            <input class="form-control" type="text" name="email_sender" size="40" value="<?php echo isset($result['email_sender'])?$result['email_sender']:'' ?>" placeholder="">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="email_subject">Email Subject:</label>
                            <input class="form-control" type="text" name="email_subject" size="40" value="<?php echo isset($result['email_subject'])?$result['email_subject']:'' ?>" placeholder="">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="provider_name">Name of Provider:</label>
                            <input class="form-control" type="text" name="provider_name" size="40" value="<?php echo isset($result['provider_name'])?$result['provider_name']:'' ?>" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="message">Email Text Usable Tags: ***NAME***,***DATE***,***PROVIDER*** </label>
                            <textarea class="form-control" cols="35" rows="8" name="message"><?php echo isset($result['message'])?$result['message']:'' ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <button class="btn btn-secondary btn-save" type="button" name="form_action" value="save" onclick="save_email_data()">Save</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
        <div class="tab active" id="tab_sms_template">
        <main class="mx-4">
                <form name="select_form" method="post" id="mysmms_form" action="">
                <?php
                 $sql1 = "select * from automatic_notification where notification_type='Ringcentral_sms'";
                 $result1 = sqlQuery($sql1);
                ?>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="message">SMS Text Usable Tags:***NAME***, ***CONSENT URL***,***DATE***,***PROVIDER***</label>
                    <textarea class="form-control" cols="35" rows="8" name="message"> <?php echo isset($result1['message'])?$result1['message']:'' ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <button class="btn btn-secondary btn-save" type="button"  onclick="sms_template()" name="form_action" value="save">Save</button>
                </div>
            </div>
        </form>
    </main>
        </div>
    </div>   
</body>
</html>
<script>
    $(".template").on('click',function(){
        var id=$(this).attr('id');
        $('.tab').removeClass('current');
        $("#tab_"+id).addClass('current');
    });

    function save_email_data(){
       
        var form=$("#email_my_form")[0];
        var data     = new FormData(form);
        $.ajax
           ({
               type        : 'POST',
               url         : "./communication.php?email_type=true",
               data        : data,
               contentType : false,
               cache       : false,
               processData : false, 
            success: function(response) 
            {
                var data1=JSON.parse(response);
                if(data1['status']=='success'){
                    signerAlertMsg(data1['msg'], 2000, 'success');
                }
                else{
                    signerAlertMsg(data1['msg'], 2000, 'danger');
                }
                
            }
        });       
                          
    }

    function sms_template()
    {
        var form=$("#mysmms_form")[0];
        var data     = new FormData(form);
        $.ajax
           ({
               type        : 'POST',
               url         : "./communication.php?sms_type=true",
               data        : data,
               contentType : false,
               cache       : false,
               processData : false, 
            success: function(response) 
            {
                var data1=JSON.parse(response);
                if(data1['status']=='success'){
                    signerAlertMsg(data1['msg'], 2000, 'success');
                }
                else{
                    signerAlertMsg(data1['msg'], 2000, 'danger');
                }
                
            }
        });

    }

    function signerAlertMsg(message, timer = 5000, type = 'success', size = '') {
        $('#signerAlertBox').remove();
        if(type=='danger'){
            var error='Alert!';
        }
        else{
            var error='Success';
        }
        size = (size == 'lg') ? 'left:25%;width:50%;' : 'left:35%;width:30%;';
        let style = "position:fixed;top:25%;" + size + " bottom:0;z-index:1020;z-index:5000";
        $("body").prepend("<div class='container text-center' id='signerAlertBox' style='" + style + "'></div>");
        let mHtml = '<div id="alertMessage" class="alert alert-' + type + ' alert-dismissable">' +
            '<button type="button" class="close btn btn-link" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<h5 class="alert-heading text-center">'+error+'</h5><hr>' +
            '<p>' + message + '</p>' +
            '</div>';
        $('#signerAlertBox').append(mHtml);
        $('#alertMessage').on('closed.bs.alert', function () {
            clearTimeout(AlertMsg);
            $('#signerAlertBox').remove();
        });
        let AlertMsg = setTimeout(function () {
            $('#alertMessage').fadeOut(800, function () {
                $('#signerAlertBox').remove();
            });
        }, timer);
    }
</script>
