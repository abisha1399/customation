<?php

/**
 * main.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Kevin Yeh <kevin.y@integralemr.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Ranganath Pathak <pathak@scrs1.org>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2016 Kevin Yeh <kevin.y@integralemr.com>
 * @copyright Copyright (c) 2016-2019 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Ranganath Pathak <pathak@scrs1.org>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */


use Esign\Api;
use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
use OpenEMR\Events\Main\Tabs\RenderEvent;

require_once("../../globals.php");


if(isset($_GET['tracker']))
{
  $pid=$_SESSION['pid'];
  $user_id=$_SESSION['authUserID'];
  $query=sqlInsert("INSERT INTO time_tracker (auth_user,pid,start_time) VALUES('$user_id','$pid',NOW())");
  echo $query;
  exit;
} 


if(isset($_GET['duration']))
{
  $hours=$_POST['hours'];
  $minutes=$_POST['minutes'];
  $seconds=$_POST['seconds'];
  $id=$_POST['new_patient'];
  $total_time=$hours.":".$minutes.":".$seconds;
  $user_id=$_SESSION['authUserID'];
  $query=sqlStatement("UPDATE `time_tracker` SET`end_time`=NOW(),`duration`='$total_time' WHERE id='$id'");
  $qry_duration=sqlQuery("SELECT * from time_tracker where id='$id'");
  $start_time=$qry_duration['start_time'];
  $end_time=$qry_duration['end_time'];
  $datetime1 = new DateTime($start_time);//start time
  $datetime2 = new DateTime($end_time);//end time
  $interval = $datetime1->diff($datetime2);
  $final_duration= $interval->format('%H:%I:%S');
  // $duration=sqlStatement("UPDATE `time_tracker` SET `duration`='$final_duration' WHERE id='$id'");
  exit;
}