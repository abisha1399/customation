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

$baseDir = $GLOBALS['OE_SITE_DIR'] . DIRECTORY_SEPARATOR . "Message-Store";
$cacheDir = $baseDir . DIRECTORY_SEPARATOR . '_cache';
$c = json_decode(file_get_contents($cacheDir . '/_credentials.php'), true);

echo "<script>var pid='" . attr($pid) . "'</script>";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Setup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Header::setupHeader(); ?>
    <script>
        $(document).ready(function () {

            $(function () {
                // when the form is submitted
                $('#setup-form').on('submit', function (e) {
                    if (!e.isDefaultPrevented()) {
                        let wait = '<i class="fa fa-cog fa-spin fa-4x"></i>';
                        let url = '?action=saveSetup';
                        // POST values in the background the the script URL
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: $(this).serialize(),
                            success: function (data) {
                                var err = (data.search(/Exception/) !== -1 ? 1 : 0);
                                var messageAlert = 'alert-' + (err !== 0 ? 'danger' : 'success');
                                var messageText = data;

                                var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';

                                if (messageAlert && messageText) {
                                    // inject the alert to .messages div in our form
                                    $('#setup-form').find('.messages').html(alertBox);
                                    // empty the form
                                    $('#setup-form')[0].reset();
                                    if (!err)
                                        setTimeout(function () {
                                            dlgclose();
                                        }, 2000);
                                }
                            }
                        });
                        return false;
                    }
                })
            });
        });

        var docInfo = function (e, ppath) {
            dlgopen("https://service.devtest.ringcentral.com/", '_blank', 1240, 900, true, 'Portal')
        };


    </script>
    <style>
        .panel-body {
            word-wrap: break-word;
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="container">
    <form class="form" id="setup-form" role="form">
        <input type="hidden" id="form_save" name="save" value=''>
        <div class="messages"></div>
        <div class="col-md-12">
            <div class="row">

                <div class="checkbox">
                    <label><input id="form_production" type="checkbox" name="production" <?php echo $c['production'] ? ' checked':'' ?>>Production</label>
                </div>
                <div class="form-group">
                    <label for="form_username">Username *</label>
                    <input id="form_username" type="text" name="username" class="form-control"
                           placeholder="Please enter Username *" required="required" value='<?php echo $c['username'] ?>'>
                </div>
                <div class="form-group">
                    <label for="form_">Phone Extension</label>
                    <input id="form_extension" type="text" name="extension" class="form-control"
                           placeholder="Please enter Extension" required="required" value='<?php echo $c['extension'] ?>'>
                </div>
                <div class="form-group">
                    <label for="form_smsnumber">SMS Number</label>
                    <input id="form_smsnumber" type="text" name="smsnumber" class="form-control"
                           placeholder="Please enter SMS Phone" value='<?php echo $c['smsNumber'] ?>'>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="form_password">Password *</label>
                    <input id="form_password" type="text" name="password" class="form-control"
                           placeholder="Please enter Password *" required="required" value='<?php echo $c['password'] ?>'>
                </div>
                <div class="form-group">
                    <label for="form_key">Application Key *</label>
                    <input id="form_key" type="text" name="key" class="form-control"
                           placeholder="Please enter key *" required="required" value='<?php echo $c['appKey'] ?>'>
                </div>
                <div class="form-group">
                    <label for="form_secret">Key Secret *</label>
                    <input id="form_secret" type="text" name="secret" class="form-control"
                           placeholder="Please enter secret *" required="required" value='<?php echo $c['appSecret'] ?>'>
                </div>
                <div class="form-group">
                    <label for="form_secret">SMS Notify Before (Hrs) *</label>
                    <input id="form_nhours" type="text" name="smshours" class="form-control"
                           placeholder="Please enter # hours befor appointment *" required="required" value='<?php echo $c['smsHours'] ?>'>
                </div>
                <div class="form-group">
                    <label for="form_secret">Message Template *</label><span style="font-size:12px;font-style: italic">&nbsp;&nbsp;Tags: ***NAME***, ***PROVIDER***, ***DATE***, ***STARTTIME***, ***ENDTIME***, ***ORG***</span>
                    <textarea id="form_message" type="text" rows="3" name="smsmessage" class="form-control"
                              placeholder="Please enter auto message *" required="required" value='<?php echo $c['smsMessage'] ?>'><?php echo $c['smsMessage'] ?></textarea>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div>
                        <p class="text-muted"><strong>*</strong> These fields are required. </p>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm pull-right" value="">Save</button>
                </div>
            </div>
        </div>
</div>

</form>

</body>
</html>
