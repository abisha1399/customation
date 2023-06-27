<?php

/**
 * This report lists patients that were seen within a given date
 * range, or all patients if no date range is entered.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2006-2016 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2017-2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

if (!empty($_POST)) {
    if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
        CsrfUtils::csrfNotVerified();
    }
}

$frm = date('Y-m-d', strtotime(date('Y-m-d') .' -10 day'));
$from_date  = (!empty($_POST['form_from_date'])) ? DateToYYYYMMDD($_POST['form_from_date']) : $frm;
$to_date    = (!empty($_POST['form_to_date'])) ? DateToYYYYMMDD($_POST['form_to_date']) : date('Y-m-d');

$patlist = trim($_POST['patfilter'] ?? '');


$userlist  = isset($_POST['userfilter']) ? $_POST['userfilter'] : '';


?>


<html>

<head>
    <title><?php echo xlt('Task Report'); ?></title>
    <?php Header::setupHeader(['datetime-picker', 'report-helper']);
    ?>
    <script>
        $(function() {
            // oeFixedHeaderSetup(document.getElementById('mymaintable'));
            top.printLogSetup(document.getElementById('printbutton'));

            $('.datepicker').datetimepicker({
                <?php $datetimepicker_timepicker = false; ?>
                <?php $datetimepicker_showseconds = false; ?>
                <?php $datetimepicker_formatInput = true; ?>
                <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
                <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma 
                ?>
            });
        });
    </script>

    <style>
        /* specifically include & exclude from printing */
        @media print {
            #report_parameters {
                visibility: hidden;
                display: none;
            }

            #report_parameters_daterange {
                visibility: visible;
                display: inline;
                margin-bottom: 10px;
            }

            #report_results table {
                margin-top: 0px;
            }
        }

        /* specifically exclude some from the screen */
        @media screen {
            #report_parameters_daterange {
                visibility: hidden;
                display: none;
            }

            #report_results {
                width: 100%;
            }
            table.dataTable thead td {
          font-weight:400;
          padding:3px;
     } 
     

     #mymaintable{
     box-shadow: 2px 2px 2px #8d8c8c;
     }
     
     
     #mymaintable_filter>label{
          float: right;
          display: inline-flex;

     } 
     
     .dataTables_paginate {
          float: right;

     }
     /* Finder Processing style */
   
        }
    </style>
    <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

</head>

<body class="body_top">
    <!-- Required for the popup date selectors -->

    <div id="overDiv" style="position: absolute; visibility: hidden; z-index: 1000;"></div>
    <span class='title'><?php echo xlt('Report'); ?> - <?php echo xlt('Task Report'); ?></span>
    <div id="report_parameters_daterange">
        <?php if (!(empty($to_date) && empty($from_date))) { ?>
            <?php echo text(oeFormatShortDate($from_date)) . " &nbsp; " . xlt('to{{Range}}') . " &nbsp; " . text(oeFormatShortDate($to_date)); ?>
        <?php } ?>
    </div>

    <form name='theform' id='theform' method='post' action='task_report.php' onsubmit='return top.restoreSession()'>

        <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />


        <div id="report_parameters">

            <input type='hidden' name='form_refresh' id='form_refresh' value='' />


                <?php
                $patient = sqlStatement("SELECT  fname,lname FROM `patient_data`");

                $provider = sqlStatement("SELECT id,username FROM `users` WHERE authorized = 1");
                ?>

                <form method='post' name='filter_form' id="filter_form">
                    <table>
                        <tr>
                            <td>
                                <label><?php echo xlt('Assign To'); ?></label></td>
                               <td> <select class="form-control" title="Choose Provider" name="userfilter" id="userfilter">
                                    <option value="">--Select Provider--</option>
                                    <?php
                                    while ($row = sqlFetchArray($provider)) { ?>
                                        <option id="<?php echo $row['id'] ?>" value="<?php echo $row['username'] ?>" <?php if ($userlist == $row['username']) {
                                                                                                                                                 echo 'selected';
                                                                                                                        } ?>>
                                            <?php echo $row['username'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </td>

                            <td>
                                <label><?php echo xlt('Patient'); ?></label></td>
                                <td><select class="form-control" title="Choose Patient" name="patfilter" id="patfilter">
                                    <option value="">-- Select Patient -- </option>
                                    <?php
                                    while ($row = sqlFetchArray($patient)) { ?>
                                        <option id="<?php echo $row['fname'] . " " . $row['lname'] ?>" value="<?php echo $row['fname'] . " " . $row['lname'] ?>" <?php if ($patlist == $row['fname'] . " " . $row['lname']) {
                                                                                                                                                                        echo 'selected';
                                                                                                                                                                    } ?>>
                                            <?php echo $row['fname'] . " " . $row['lname'] . "" ?>
                                        </option>
                                    <?php }
                                    ?>
                                </select>
                            </td>
                            

                                <td><label><?php echo xlt('From'); ?></label><td>
                                <td><input class='datepicker form-control' type='text' name='form_from_date' id="form_from_date" size='10' value='<?php echo attr(oeFormatShortDate($from_date)); ?>'>
                            </td>
                            <td> <label><?php echo xlt('To'); ?></label></td>

                               <td> <input class='datepicker form-control' type='text' name='form_to_date' id="form_to_date" size='10' value='<?php echo attr(oeFormatShortDate($to_date)); ?>'>

                            </td>
                            <td>
                                <input type="hidden" id="fill" name="fill" value="1" />

                                <!--submit-->
                                <a href='#' class='btn btn-secondary btn-save' onclick='$("#form_csvexport").val(""); 
                                 $("#form_refresh").
                                attr("value","true"); $("#theform").submit();'>
                                    <?php echo xlt('Submit'); ?>
                                </a>
                            </td>
    
        </tr>
        </table>
        <?php
        if (!empty($patlist) || !empty($userlist) || !empty($from_date) || !empty($to_date)) {

        ?>
            <div>
                <table class="table table-sm table-hover w-100" id='mymaintable'>


                    <thead >
                        <th><?php echo xlt('Assigned By'); ?> </th>
                        <th> <?php echo xlt('Patient Name'); ?> </th>
                        <th> <?php echo xlt('Encounter ID'); ?> </th>
                        <th> <?php echo xlt('Assigned To'); ?> </th>
                        <th> <?php echo xlt('Task'); ?> </th>
                        <th> <?php echo xlt('Start Date'); ?> </th>
                        <th> <?php echo xlt('End Date'); ?> </th>
                        <th> <?php echo xlt('Status'); ?> </th>
        </thead>

                        <?php
                        // $from_date = $_POST['form_from_date'];
                        // $to_date = $_POST['form_to_date'];
                        $totalpts = 0;
                        $sqlArrayBind = array();
                        $query = "SELECT concat(u.fname,' ',u.lname) as user,concat(p.fname,' ',p.lname) as pname,t.* FROM task_manager AS t left join patient_data as p on t.pid = p.pid join users as u on u.id = t.uid where ";


if ((!empty($from_date)) && (!empty($to_date))) {
        $query .= " t.start_date >= '$from_date' AND t.start_date <= '$to_date' ";

    if ($patlist) {
        $query .= "AND t.pname = ? ";
        array_push($sqlArrayBind, $patlist);
    }
    if ($userlist) {
        $query .=  "AND t.assigned_to = ? ";
        array_push($sqlArrayBind, $userlist);
    }
// print_r($query);
                        $res = sqlStatement($query, $sqlArrayBind);
}

                        while ($row = sqlFetchArray($res)) {
                        ?>
                        
                            <tr>
                                <td>
                                    <?php echo text($row['assigned_by']); ?>
                                </td>
                                <td>
                                    <?php echo text($row['pname']); ?>
                                </td>
                                <td>
                                    <?php echo text($row['enc_id']); ?>
                                </td>
                                <td>
                                    <?php echo text($row['user']); ?>
                                </td>
                                <td>
                                    <?php echo text($row['task']); ?>
                                </td>
                                <td>
                                    <?php echo text($row['start_date']); ?>
                                </td>
                                <td>
                                    <?php echo text($row['end_date']); ?>
                                </td>
                                <td>
                                    <?php echo text($row['status']); ?>
                                </td>
                            </tr>
            </div>
    <?php
                        }
                    } else {
                        echo 'Please input search criteria above, and click Submit to view results.';
                    }

    ?>
    </table>
</body>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> 


<script>
    $(document).ready(function() {
        $('#mymaintable').DataTable();
    });
</script>