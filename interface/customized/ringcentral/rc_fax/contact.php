<?php
/**
 *	oeMessage
 *  Fax UI (REST interface Fax/SMS)
 *	Copyright (c)2018 - Jerry Padgett. Padgett's Consulting
 *
 *	This program is licensed software: licensee is granted a limited nonexclusive
 *  license to install this Software on more than one computer system, as long as all
 *  systems are used to support a single licensee. Licensor is and remains the owner
 *  of all titles, rights, and interests in program.
 *
 *  Licensee will not make copies of this Software or allow copies of this Software
 *  to be made by others, unless authorized by the licensor. Licensee may make copies
 *  of the Software for backup purposes only.
 *
 *	This program is distributed in the hope that it will be useful, but WITHOUT
 *	ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 *  FOR A PARTICULAR PURPOSE. LICENSOR IS NOT LIABLE TO LICENSEE FOR ANY DAMAGES,
 *  INCLUDING COMPENSATORY, SPECIAL, INCIDENTAL, EXEMPLARY, PUNITIVE, OR CONSEQUENTIAL
 *  DAMAGES, CONNECTED WITH OR RESULTING FROM THIS LICENSE AGREEMENT OR LICENSEE'S
 *  USE OF THIS SOFTWARE.
 *
 *  @package oeMessage
 *  @version 1.0
 *  @copyright Jerry Padgett
 *  @author Jerry Padgett <sjpadgett@gmail.com>
 *  @uses Fax and Patient SMS Notifications
 *
 **/

require_once("../../../globals.php");
require_once("./libs/controller/ClientAppController.php");

use OpenEMR\Core\Header;

// kick off app endpoints controller
$clientApp = new clientController();

echo "<script>var pid='" . attr($pid) . "'</script>";
$vendor=$GLOBALS['VENDOR_METHOD'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Header::setupHeader(/*['opener', 'datetime-picker']*/); ?>
    <script>
        $(document).ready(function () {

            $(function () {
                // when the form is submitted
                $('#contact-form').on('submit', function (e) {
                    if (!e.isDefaultPrevented()) {
                        let wait = '<i class="fa fa-cog fa-spin fa-4x"></i>';
                        <?php 
                        if($vendor=="Twilio")
                        {
                            ?>
                        let url = '../../../../modules/sms_email_reminder/cron_fax_notification.php';
                        <?php
                        }
                        else
                        {
                            ?>
                             let url = '?action=sendFax';
                        <?php 
                        }
                        ?>
                        // POST values in the background the script URL
                        var postfile=$('#form_file').val();
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: $(this).serialize(),
                            success: function (data) {
                               
                                var err = (data.search(/Exception/) !== -1 ? 1 : 0);
                                // we recieve the type of the message: success x danger and apply it to the
                                var messageAlert = 'alert-' + (err !== 0 ? 'danger' : 'success');
                                var messageText = data;

                                // let's compose Bootstrap alert box HTML
                                var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';

                                // If we have messageAlert and messageText
                                if (messageAlert && messageText) {
                                    // inject the alert to .messages div in our form
                                    $('#contact-form').find('.messages').html(alertBox);
                                    // empty the form
                                    $('#contact-form')[0].reset();
                                    if(!err)
                                setTimeout(function() { fileremove(postfile);  }, 4000);
                                setTimeout(function() {  dlgclose();  }, 6000);
                                }
                            }
                        });
                        return false;
                    }
                })
            });
        });
      function fileremove(data)
      {
        $.ajax({
                            type: "POST",
                            url: './del.php?action=unlink',
                            data:{"dfile":data},
                            success: function (data) {
                                console.log(data);
                            }
                        });
      }
        var docInfo = function (e, ppath) {
            dlgopen("https://service.devtest.ringcentral.com/", '_blank', 1240, 900, true, 'Portal')
        };

        function contactCallBack(contact) {
            let actionUrl = '?action=getUser';
            return $.post(actionUrl, {'uid': contact}, function (d, s) {
                //$("#wait").remove()
            }, 'json').done(function (data) {
                $("#form_name").val(data[0]);
                $("#form_lastname").val(data[1]);
                $("#form_phone").val(data[2]);
            });
        }

        var getContactBook = function (e, rtnpid) {
            e.preventDefault();
            dlgopen('', 'callInfo', 'modal-lg', 200, '', 'Contacts', {
                buttons: [
                    {text: 'Close', close: true, style: 'primary  btn-sm'}
                ],
                //onClosed: 'docInfo',
                url: top.webroot_url + '/interface/usergroup/addrbook_list.php?popup=2&fax=1',
                sizeHeight: 'auto',
                allowResize: true,
                allowDrag: true,
                dialogId: 'fax',
                type: 'iframe'
            });
        };

    </script>
    <style>
        .panel-body {
            word-wrap: break-word;
            overflow: hidden;
        }
        .form-group{
            width:100% !important;
        }
    </style>
</head>
<body>
<div class="container">

    <form class="form" id="contact-form" method="post"  role="form">

        <input type="hidden" id="form_file" name="file" value='<?php echo $_REQUEST['file']; ?>'>

        <input type="hidden" id="form_isContent" name="isContent" value='<?php echo $_REQUEST['isContent']; ?>'>
        <input type="hidden" id="form_isDocuments" name="isDocuments" value=''>

        <div class="messages"></div>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group">
                    <label for="form_name">Firstname *</label>
                    <input id="form_name" type="text" name="name" class="form-control"
                           placeholder="Please enter firstname *" required="required"
                           data-error="Firstname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>  
            <div class="row">  
                <div class="form-group">
                    <label for="form_lastname">Lastname *</label>
                    <input id="form_lastname" type="text" name="surname" class="form-control"
                           placeholder="Please enter lastname *" required="required"
                           data-error="Lastname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="form_email">Email</label>
                    <input id="form_email" type="email" name="email" class="form-control"
                           placeholder="Please enter email (not required for fax)">
                    <div class="help-block with-errors"></div>
                </div>
            </div>   
            <div class="row"> 
                <div class="form-group">
                    <label for="form_phone">Fax Phone *</label>
                    <input id="form_phone" type="tel" name="phone" class="form-control"
                           placeholder="Please enter Fax phone *" required="required"
                           data-error="Valid phone is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Message</label>
                    <textarea id="form_message" name="comments" class="form-control" placeholder="Comment for cover sheet"
                              rows="4" data-error="Please,leave comment."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div> 
        <div class="row">   
            <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-sm" onclick="getContactBook(event, pid)" value="Contacts">Contacts</button>
                <button type="submit" class="btn btn-success btn-sm" value="">Send Fax</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><strong>*</strong> These fields are required. </p>
            </div>
        </div>
</div>

</form>

</body>
</html>
