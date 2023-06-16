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

ini_set('display_errors',true);
// kick off app endpoints controller
$clientApp = new clientController();

echo "<script>var pid='" . attr($pid) . "'</script>";
echo "<script>var portalUrl='" . attr($clientApp->portalUrl) . "'</script>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fax/SMS</title>
    <link rel="stylesheet" href="../../../../public/assets/bootstrap-3-3-4/dist/css/bootstrap.min.css?v=42" type="text/css">
<link rel="stylesheet" href="../../../themes/style_ash_blue.css?v=42?v=42" type="text/css">
<link rel="stylesheet" href="../../../../public/assets/font-awesome-4-6-3/css/font-awesome.min.css?v=42" type="text/css">
<link rel="stylesheet" href="../../../../public/assets/jquery-datetimepicker/build/jquery.datetimepicker.min.css?v=42" type="text/css">

 <script type="text/javascript" src="../../../../public/assets/jquery-min-3-1-1/index.js?v=42"></script>
<script type="text/javascript" src="../../../../public/assets/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js?v=42"></script>
<script type="text/javascript" src="../../../../library/dialog.js?v=61"></script>
<script type="text/javascript" src="../../../main/tabs/js/include_opener.js?v=61"></script>
<script type="text/javascript" src="../../../../public/assets/bootstrap-3-3-4/dist/js/bootstrap.min.js?v=42"></script>
<!--<script type="text/javascript" src="../../../../public/assets/bootstrap/dist/js/bootstrap.bundle.min.js?v=61"></script>
<script type="text/javascript" src="../../../../library/textformat.js?v=42"></script>
<script type="text/javascript" src="../../../../library/js/utility.js?v=61"></script>

<script type="text/javascript" src="../../../../interface/errorReview.js?v=42"></script> -->


    <script>
        function refreshme() {
window.location.reload();
}
        $(document).ready(function () {
            $('.datepicker').datetimepicker({
                <?php $datetimepicker_timepicker = false; ?>
                <?php $datetimepicker_showseconds = false; ?>
                <?php $datetimepicker_formatInput = false; ?>
                <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
            });
            var dateRange = new Date(new Date().setDate(new Date().getDate() - 7));
            $("#fromdate").val(dateRange.toJSON().slice(0, 10))
            $("#todate").val(new Date().toJSON().slice(0, 10))
        });

        var docInfo = function (e, ppath) {
            dlgopen(ppath, '_blank', 1240, 900, true, 'Your Account Portal')
        };

        var popNotify = function (e, ppath) {
            if(e === 'live') {
                let yn = confirm("Are you sure you wish to send all scheduled reminders now!\n\nClick OK to confirm.");
                if (!yn) return false;
            }
            dlgopen(ppath, '_blank', 1240, 900, true, 'Appointment Reminder Alerts')
        };

        function contactCallBack(contact) {
            alert('here: ' + contact);
            return;
        }

        var docDialog = function (e, ppath) {
            dlgopen('', 'appInfo', 'modal-lg', 400, '', 'Contacts', {
                buttons: [
                    {text: 'Close', close: true, style: 'primary  btn-sm'}
                ],
                //onClosed: 'docInfo',
                url: top.webroot_url + '/interface/usergroup/addrbook_list.php?popup=2',
                sizeHeight: 'auto',
                allowResize: true,
                allowDrag: true,
                dialogId: 'fax',
                type: 'iframe'
            });
        };

        var doSetup = function (e) {
            top.restoreSession();
            e.preventDefault();
            $('.navbar .container').css('display','block');
                    $('.navbar-nav').css('flex-direction','row');
                    $('.navbar-nav').css('margin-right','94px');
                   
                   $('#container').addClass('container-fluid');
                   $('#container').removeClass('container');
                   $('#container').css('margin-left','94px');
            dlgopen('', 'setup', 'modal-md', 700, '', 'Credentials and SMS Notifications', {
                /*buttons: [
                    {text: 'Close', close: true, style: 'primary  btn-sm'}
                ],*/
                //onClosed: 'docInfo',
                onClosed: 'refreshme',
                url: 'setup.php',
                sizeHeight: 'full',
                allowResize: true,
                allowDrag: true,
                dialogId: 'fax',
                type: 'iframe'
            });
        };
// For use with window cascade popup using encoded data uri
        function viewDocument(e, docuri) {
            top.restoreSession();
            e.preventDefault();
            e.stopPropagation();
            let wait = '<i class="fa fa-cog fa-spin fa-4x"></i>';
            let actionUrl = '?action=getStoredDoc';

            return $.post(actionUrl, {'docuri': docuri, 'pid': pid})
                .done(function (data) {
                    let btnClose = 'Done';
                    let url = data;
                    let width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                    let height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
                    height = screen.height ? screen.height * 0.95 : height;
                    if (data.search(/data:/) !== -1) {
                        cascwin(url, '', width / 2, (height), "resizable=1,scrollbars=1,location=0,toolbar=0").focus();
                    } else {
                        alert(data);
                    }
                });
        }

        function getDocument(e, docuri, docid, downFlag) {
            top.restoreSession();
            e.preventDefault();
            e.stopPropagation();
            let wait = '<span id="wait"><?php echo xlt("Fetching Document .. ");?><i class="fa fa-cog fa-spin fa-2x"></i></span>';
            let actionUrl ='?action=viewFax';
            $("#brand").append(wait);
            $('#submit_data').prop('disabled', true);
            return $.post(actionUrl, {'docuri': docuri, 'docid': docid, 'pid': pid, download: downFlag})
                .done(function (data) {
                    $("#wait").remove();
                    $('#submit_data').prop('disabled', false);
                    $('.navbar .container').css('display','block');
                    $('.navbar-nav').css('flex-direction','row');
                    $('.navbar-nav').css('margin-right','94px');
                   
                   $('#container').addClass('container-fluid');
                   $('#container').removeClass('container');
                   $('#container').css('margin-left','94px');
    
                    if(downFlag === 'true'){
                        location.href = "index.php?action=disposeDoc&where=" + encodeURIComponent(data.trim());
                        return false;
                    }

                    let btnArray = [/*{text: "Contacts", close: false, style: "success  btn-sm", click: docDialog},*/{text: "Done", close: true, style: "default  btn-sm"}];
                    let btnClose = 'Done';
                    let url = data.trim();
                    let width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                    let height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
                    height = screen.height ? screen.height * 0.85 : height;
                    dlgopen(url, 'disposefax', 'modal-mlg', 400, '', '', {
                        //buttons: btnArray,
                        url: url,
                        sizeHeight: 'full',
                        allowResize: true,
                        allowDrag: true,
                        dialogId: 'fax',
                        type: 'iframe'
                    });
                });
        }

        function retrieveMsgs(e, req) {
            top.restoreSession();
            e.preventDefault();
            e.stopPropagation();

            //getNotificationLog();
            //getLogs();

            let wait = '<span id="wait"><?php echo xlt("Fetching Remote .. ");?><i class="fa fa-cog fa-spin fa-2x"></i></span>';
            let actionUrl = '?action=getPending';
            let id = pid;
            let datefrom = $('#fromdate').val();
            let dateto = $('#todate').val();
            let data = new Array();

            $("#brand").append(wait);
            $('#submit_data').prop('disabled', true);
            return $.post(actionUrl, {'pid': pid, 'datefrom': datefrom, 'dateto': dateto}, function (d, s) {
                getLogs();
                $('#submit_data').prop('disabled', false);
                $("#wait").remove();
            }, 'json').done(function (data) {
                $("#rcvdetails tbody").empty().append(data['received']);
                $("#sentdetails tbody").empty().append(data['sent']);
                $("#msgdetails tbody").empty().append(data['sms_log']);
            });

        };

        function getLogs() {
            top.restoreSession();

            let actionUrl = '?action=getCallLogs';
            let id = pid;
            let datefrom = $('#fromdate').val();
            let dateto = $('#todate').val();

            //$("#logdetails tbody").empty().html(wait);
            return $.post(actionUrl, {
                'pid': pid,
                'datefrom': datefrom,
                'dateto': dateto
            }).done(function (data) {
                $("#logdetails tbody").empty().append(data);
                getNotificationLog();
            });
        };

        function getNotificationLog() {
            top.restoreSession();

            let actionUrl = '?action=getNotificationLog';
            let id = pid;
            let datefrom = $('#fromdate').val() + " 00:00:00";
            let dateto = $('#todate').val() + " 23:59:59";

            //$("#logdetails tbody").empty().html(wait);
            return $.post(actionUrl, {
                'pid': pid,
                'datefrom': datefrom,
                'dateto': dateto
            }).done(function (data) {
                $("#alertdetails tbody").empty().append(data);
            });
        };
        $(function(){
            $( "#submit_data" ).trigger( "click" );
        });

        function getSelResource() {
            return $('#resource option:selected').val();
        }

    </script>
    <style>
        .panel-body {
            word-wrap: break-word;
            overflow: hidden;
        }
    </style>
    
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container" id="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#nav-header-collapse">
                <span class="sr-only"><?php echo xlt('Toggle'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <?php echo xlt('oeMessaging (RingCentral)'); ?>
            </a>

        </div>
        <div class="collapse navbar-collapse" id="nav-header-collapse">
            <form class="navbar-form navbar-left form-inline" method="GET" role="search">
                <!--<div class="form-group">
                    <input type="text" name="q" class="form-control input-sm"
                           placeholder="<?php /*echo xla('Search'); */ ?>">
                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                </div>-->

                <div class="form-group">
                    <label for="formdate"><?php echo xlt('Activities From Date:') ?></label>
                    <input type="text" id="fromdate" name="fromdate" class="form-control input-sm datepicker"
                           placeholder="YYYY-MM-DD" value=''>
                </div>
                <div class="form-group">
                    <label for="todate"><?php echo xlt('To Date:') ?></label>
                    <input type="text" id="todate" name="todate" class="form-control input-sm datepicker"
                           placeholder="YYYY-MM-DD" value=''>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-default" id="submit_data" onclick="retrieveMsgs(event,this)" title="Click to get current history.">
                        <i class="glyphicon glyphicon-refresh"></i></button><span id="brand"></span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php echo xlt('Actions'); ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <!--<li class="dropdown-header"><strong><?php /*echo xlt('Setup'); */?></strong></li>-->
                        <li class=""><a href="#" onclick="doSetup(event)"><?php echo xlt('Account Credentials'); ?></a></li>
                        <li class=""><a href="#" onclick="popNotify('', './rc_sms_notification.php?dryrun=1&site=<?php echo $_SESSION['site_id'] ?>')"><?php echo xlt('Test SMS Reminders'); ?></a></li>
                        <li class=""><a href="#" onclick="popNotify('live', './rc_sms_notification.php?site=<?php echo $_SESSION['site_id'] ?>')"><?php echo xlt('Send SMS Reminders'); ?></a></li>
                        <li><a href="#" onclick="docInfo(event, portalUrl)"><?php echo xlt('Portal Gateway'); ?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" onclick="docInfo(event, portalUrl)"><?php echo xlt('Visit Account Portal'); ?></a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid main-container" style="margin-top:50px">

    <div class="col-md-10 col-md-offset-1 content">

        <h3>Activities</h3>
        <div id="dashboard" class="panel">
            <!-- Nav tabs -->
            <ul id="tab-menu" class="nav nav-tabs" role="tablist">
                <li class="active" role="presentation"><a href="#received" aria-controls="received" role="tab" data-toggle="tab">Received</a>
                </li>
                <li role="presentation"><a href="#sent" aria-controls="sent" role="tab" data-toggle="tab">Sent</a>
                </li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">SMS Log</a>
                </li>
                <li role="presentation"><a href="#logs" aria-controls="logs" role="tab" data-toggle="tab">Call Log</a>
                </li>
                <li role="presentation"><a href="#alertlogs" aria-controls="alertlogs" role="tab" data-toggle="tab">Notifications Log&nbsp;&nbsp;<span class="glyphicon glyphicon-refresh" onclick="getNotificationLog(event,this)" title="Click to refresh using current date range above. Refresh just this tab."></span></a>
                </li>
                <!--<li role="presentation"><a href="#notifyPatient" aria-controls="alertlogs" role="tab" data-toggle="tab">Notify Dashboard</a></li>-->
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="received">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped" id="rcvdetails">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Pages</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Result</th>
                                <th>Download</th>
                                <th>View</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No Items .. Try Refresh</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="sent">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped" id="sentdetails">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Pages</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Result</th>
                                <th>Download</th>
                                <th>View</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No Items .. Try Refresh</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped" id="msgdetails">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Result</th>
                                <th>Download</th>
                                <th>View</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No Items .. Try Refresh</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="logs">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped" id="logdetails">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                                <th>Result</th>
                                <th>Id</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No Items .. Try Refresh</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="alertlogs">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped" id="alertdetails">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Date Sent</th>
                                <th>Appt Date Time</th>
                                <th>Patient</th>
                                <th>Message</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>No Items</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--<div role="tabpanel" class="tab-pane" id="notifyPatient">
                    <div class="panel container-fluid">

                    </div>
                </div>-->
            </div>
        </div>
        <!--</div>-->
        <footer class="pull-left footer">
            <p class="col-md-12">
            <hr class="divider">
            </p>
        </footer>
    </div>

</body>
</html>
