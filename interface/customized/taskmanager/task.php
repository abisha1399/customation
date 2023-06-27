<?php

/**
 * Message and Reminder Center UI
 *
 * @Package OpenEMR
 * @link http://www.open-emr.org
 * @author OpenEMR Support LLC
 * @author Roberto Vasquez <robertogagliotta@gmail.com>
 * @author Rod Roark <rod@sunsetsystems.com>
 * @author Brady Miller <brady.g.miller@gmail.com>
 * @author Ray Magauran <magauran@medfetch.com>
 * @author Tyler Wrenn <tyler@tylerwrenn.com>
 * @copyright Copyright (c) 2010 OpenEMR Support LLC
 * @copyright Copyright (c) 2017 MedEXBank.com
 * @copyright Copyright (c) 2018-2019 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2020 Tyler Wrenn <tyler@tylerwrenn.com>
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once("$srcdir/pnotes.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");
require_once "$srcdir/user.inc";
// ini_set('display_errors',false);
use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Common\Logging\EventAuditLogger;
use OpenEMR\Core\Header;
use OpenEMR\OeUI\OemrUI;
ini_set('display_errors', false);
$provider = sqlStatement("SELECT id,username FROM `users` WHERE authorized = 1 ");
$patient = sqlStatement("SELECT pid,fname,lname FROM `patient_data`");
$authuser = $_SESSION['authUser'];


//SELECT t.*, f.date as encdate FROM `task_manager` as t join `form_encounter` as f on t.enc_id = f.id where t.pid = 
if(isset($_POST['edit'])){

     $query=sqlStatement("SELECT * FROM `task_manager` WHERE id=$_POST[edit]");
     $result=json_encode($query);
     echo "$result";
          exit();
}
if(isset($_POST['archive_id'])){
     
     $query=sqlStatement("UPDATE `task_manager` SET `archive`='Archived' WHERE id=$_POST[archive_id]");
     echo "Task Archived!";
          exit();
}
if(isset($_POST['unarchive_id'])){
     
     $query=sqlStatement("UPDATE `task_manager` SET `archive`='' WHERE id=$_POST[unarchive_id]");
     echo "Task Unarchived!";
          exit();
}
if(isset($_POST['update_id'])){
     
     $query=sqlStatement("UPDATE `task_manager` SET `status`='Reopened',`new_status`='2' WHERE id=$_POST[update_id]");
     echo "Task Re-opened!";
          exit();
}
if(isset($_POST['new_id'])){

     $query=sqlStatement("SELECT * FROM `task_manager` WHERE id=$_POST[new_id]");
     $result=json_encode($query);
     echo "$result";
          exit();
}


if(isset($_POST['id'])){
     $id=$_POST['id'];
 $sqlupdate = sqlStatement("UPDATE `task_manager` SET `status`='Completed',`new_status`='3' WHERE id=$id");
 echo "Task Completed!";exit();
}
if(!empty(isset($_POST['task'])&&($_POST['assign_new']))){
     //  print_r($POST);die();
     $user = $_POST['user'];
     $pat = $_POST['pat']?$_POST['pat']:"";
     $pat1 = $_POST['pat1']?$_POST['pat1']:"";
     $uid= $_POST['uid'];
     $enc = $_POST['enc']?$_POST['enc']:"";
     $sdate = $_POST['sdate'];
     $edate = $_POST['edate'];
     $task = $_POST['task'];
     $hidden=$_POST['hidden'];
     $hidden2=$_POST['hidden2'];
     $loginuser = $_SESSION['authUser'];
     $queryrun = "";
     $hidden_val = "";
     $hidden2_val = "";
     for($count = 0; $count<count($user); $count++)
     {
      $user_val = $user[$count];
      $uid_val=$uid[$count];
      $pat_val = $pat[$count];
      $pat1_val = $pat1[$count];
      $enc_val = $enc[$count];
      
     if($enc_val == 'null'){
          $enc_val ='';
     }
      $sdate_val = $sdate[$count];
      $edate_val = $edate[$count];
      $task_val = $task[$count];
      $hidden_val = $hidden[$count];
      $hidden2_val = $hidden2[$count];
      if($user_val != '' || ($pat_val != '' || $pat1_val != '' || $uid_val !='' || $enc_val != '')|| $sdate_val != '' && $edate_val != '' && $task_val != '')
      {
          if($hidden2_val!=''){
               $queryrun = sqlStatement("UPDATE `task_manager` SET `pname`='$pat_val',`pid`='$pat1_val',`enc_id`='$enc_val',`uid`='$uid_val',`assigned_by`='$loginuser',`assigned_to`='$user_val',`task`='$task_val',`start_date`='$sdate_val',`end_date`='$edate_val' WHERE id='$hidden2_val'");
             
          }
        else if($hidden_val!='') {
          $queryrun = sqlInsert("INSERT INTO `task_manager`( `pid`, `enc_id`,  `pname`,`uid`,`assigned_by`, `assigned_to`, `task`, `start_date`,`end_date`, `status`,`new_status`) VALUES ('$pat1_val','$enc_val','$pat_val','$uid_val','$loginuser','$user_val','$task_val','$sdate_val','$edate_val','Reassigned','1')");
              
       }
       else{
          $queryrun = sqlInsert("INSERT INTO `task_manager`( `pid`, `enc_id`,  `pname`,`uid`,`assigned_by`, `assigned_to`, `task`, `start_date`,`end_date`, `status`,`new_status`) VALUES ('$pat1_val','$enc_val','$pat_val','$uid_val','$loginuser','$user_val','$task_val','$sdate_val','$edate_val','Assigned','0')");
    
     }

      }
  
     }
   
     if(($hidden_val =='') && ($hidden2_val =='')){
     echo "Task Assigned";
     exit();
     }
     else if($hidden2_val!=''){
     echo"Task Updated";
     exit();
     }
     else{
          echo"Task Re-Assigned";
          exit();
     }
    
} // assign_new ends

if(isset($_POST['patid'])){
     $patid =$_POST['patid'];
     $encounter = sqlStatement("SELECT e.id,e.date,c.pc_catname as name FROM `form_encounter` as e join `openemr_postcalendar_categories` as c on c.pc_catid = e.pc_catid where pid = $patid ORDER BY e.date DESC");
    
     $enc_data = array();
     while($row = sqlFetchArray($encounter)){
          $enc_data[]=$row;
     };

    echo json_encode($enc_data);exit();

}


echo "<title>" .  xlt('Task Manager') . "</title>";
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="MedEx Bank" />
<meta name="author" content="OpenEMR: MedExBank" />
<?php Header::setupHeader(['datetime-picker', 'opener', 'moment', 'select2']); ?>
<link rel="stylesheet" href="<?php echo $webroot; ?>/interface/main/messages/css/reminder_style.css?v=<?php echo $v_js_includes; ?>">

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>



<link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="" href= "https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<script src="<?php echo $GLOBALS['web_root']; ?>/interface/main/messages/js/reminder_appts.js?v=<?php echo $v_js_includes; ?>"></script>
<style>

    body{
     font-family: "Poppins", sans-serif;
     font-weight: 400;
     line-height: 2;
     text-align: left;
     }
    
     #assign1{
          float: right;
          margin: 40px 0px 0px 0px;
          padding:7px 10px;
          font-size:14px;
          font-weight: 600;
     }

     .addtask{
          padding:5px 8px;
          float:right;
          box-shadow: 3px 4px 3px #8d8c8c;
     }
     .archievebtn{
          padding:5px 8px;       
          box-shadow: 3px 4px 3px #8d8c8c;
     }
     .alerttask{
          background:#ffd3d3;
     }
     .alertsuccess{
          background:#e2ffd3;
     }
     .alertdone{
          background:#fefefe;
     }

     #cnfrm{
          display: none;
          position: fixed;
          top: 35%;
          left: 40%;
          font-weight:bold;
          font-size:20px;
          padding: 15px 30px;
          border:none;
          box-shadow: 4px 5px 3px #ccc;
          background: #efededd6;
           color: #28a745;
           z-index: 1002;
          overflow: auto;
     }
     

     .success1 {
          display: none;
          position: fixed;
          top: 35%;
          left: 40%;
          font-weight:bold;
          font-size:20px;
          padding: 15px 30px;
          border:none;
          box-shadow: 4px 5px 3px #ccc;
           color: #28a745;
          z-index: 1002;
          overflow: auto;
          background:#FFF;
     }

     .failure1 {
          color: #a94442;
          background-color: #f2dede;
          border-color: #ebccd1;
          display: none;
     }
     table.dataTable thead td {
          font-weight:400;
          padding:3px;
     } 
     table.dataTable td {
     font-size: 14px!important;
     }

     #mymaintable{
     box-shadow: 2px 2px 2px #8d8c8c;
     }
      #mymaintable_length>label{
          float:left;
          display: inline-flex;
     }
     
     #mymaintable_filter>label{
          float: right;
          display: inline-flex;

     } 
     .dataTables_info{
          float:left;
     }
     .dataTables_paginate {
          float: right;

     }
     /* Finder Processing style */
    div.dataTables_wrapper div.dataTables_processing {
        width: auto;
        margin: 0;
        color: var(--danger);
        transform: translateX(-50%);
    }
    .card {
        border: 0;
        border-radius: 0;
    }

    @media screen and (max-width: 640px) {
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            float: inherit;
            text-align: justify;
        }
    }

    table.dataTable tbody tr {
        /* background-color: var(--white) !important; */
        cursor: pointer;
    }

    table.dataTable.no-footer {
        border-bottom: 1px solid var(--gray900) !important;
    }
     table.dataTable thead tr td input {
      width: 100%;
       
     }
     table.dataTable thead tr td input::placeholder{
          font-size:12px;
     }
     #filter_btn{
          /* border-radius:20px;
          padding:7px; 
          font-size: 15px;*/
          font-weight:bold;
          color:#fff;
          box-shadow: 2px 2px 2px #8d8c8c;
     }
     .modal-header i{
          padding-left: 15px;
          font-weight:400px;
          color:red;
     }
</style>
<script>
     $(".addtask").click(function(){
          alert(1);
     $('#myModal').modal({backdrop: "static"});
})
     var EncounterIdArray = new Array;
     var EncounterDateArray = new Array;
     var CalendarCategoryArray = new Array;

</script>
</head>
<body class='body_top'>
    <div class="container-fluid mt-3" style="padding: 30px 100px;">
     
    <div class="alert-box success1 alert alert-primary">Successful Alert !!!</div>
<div class="alert-box failure1">Failure Alert !!!</div>
        <div class="row"> 
          <div class="col-12">
              
<div style="float:right">
               <form action="task.php" method="post" id="myform">
               <input type='hidden' class='btn btn-success font-weight-bold ' name='archive' id='archive' value='Archived'>
               </form>
         
         
      <button onclick="$('#myform').submit()" class="archievebtn btn font-weight-bold" style="background-color: aquamarine;">&nbsp;<i class="fa-solid fa-file-zipper"></i> Archived</button>&nbsp;&nbsp;
<button class="btn" style="background-color: #7c7c7c;" id="filter_btn"><i class='fa fa-filter'></i> &nbsp;Filter</button>&emsp;
<button class="addtask btn btn-success font-weight-bold"  data-bs-toggle="modal" data-bs-target="#myModal"><i class='fa fa-plus'></i> ADD TASK</button>

</div><br><br>
<div class="col-md-12">
<?php
               if(isset($_POST['archive'])){
                    ?>
                    <script>$(".archievebtn").css('display','none');</script>
                    <h3 class="text-left">Archived Records List&nbsp;&nbsp;<a class='btn btn-danger font-weight-bold' href="task.php" id='back'>Back</a></h3>
           

                  <?php
               }
               ?>
</div>
<?php
if($_POST['fill']==1){
     ?>
<div class="filter_hide">
              <h3 class="text-left">Filtered Records List&nbsp;&nbsp;<a class='btn btn-danger font-weight-bold' href="task.php" id='back'>Back</a></h3>
</div> 
<?php
}
?>
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Task</h5>&emsp;&emsp;<small style="color:red;padding-top:3px;"> * Fields are Mandatory!</small>
        <i class="error_alert"></i>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form method='post' name='assign_form' id="assign_form">
     <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
     <input type="hidden" name="hidden" id="hidden" value="">
       <input type="hidden" name="edit" id="edit" value="">
     <div class="form-row">
            <div class="forms col-md-4">
               <label class="h6"><?php echo xlt('Assign To'); ?><b style="color:red"> *</b></label><br>
               
               <input type="text" id="userslist" name="userslist" class="form-control" placeholder="Select Provider" title="Select Provider" autocomplete='off'  onclick='sel_provider()'>
               <input type="hidden" class="uids" id="uids" name="uids">
               <!-- <select class="form-control" title="Choose Provider" name="userslist" id="userslist"
               >
               <option value="">--Select Provider--</option>
                    <?php 
                    while($row = sqlFetchArray($provider)){?>
                         <option id="<?php echo $row['id'] ?>" value="<?php echo $row['username'] ?>"><?php echo $row['username'] ?></option>
                         <?php }
                    ?>
               </select> -->
          </div>
          <div class="forms col-md-4">
               <label class="h6"><?php echo xlt('Patient'); ?></label><br>
               <input type="text" id="patlist" name="patlist" class="form-control" placeholder="Select Patient" title="Select Patient" autocomplete='off'  onclick='sel_patient()'>
               <input type="hidden" id="pids" name="pids">

           </div>
           <div class="forms col-md-4">
               <label class="h6"><?php echo xlt('Encounter'); ?></label><br>
                <select name="enc" id="enc" class="form-control" placeholder="Encounter" title="Encounter" required >
                
                </select>
           </div>
          </div>
          <b class="row" id="enc_alert" style="color:red;float:right;padding-right:20px;"></b>
          <br>
          <div class="form-row">
          <div class="forms col-md-6">
           <label class="h6"><?php echo xlt('Start Date'); ?><b style="color:red"> *</b></label><br>
                <input type="date" name="sdate" id="sdate" class="form-control" title="Start date" value="<?php echo date('d/m/Y') ?>" required />
           </div>
           <div class="forms col-md-6">
           <label class="h6"><?php echo xlt('End Date'); ?></label><br>
                <input type="date" name="edate" id="edate" class="form-control" title="End date" value="" />
           </div>
          </div>
          <br>
     <div class="form-row">
     <div class="forms col-md-6">
          <label class="h6"><?php echo xlt('List of Task(s)'); ?><b style="color:red"> *</b></label><br>
          <textarea name="task" id="task" class="form-control" placeholder="List of Task(s)" title="List of Task(s)" required></textarea>
     </div>
     <div class="forms col-md-6" style="margin-top: 40px;padding-left: 30px;">
          <input type="button" class="btn btn-primary add" id="add" name="add"  value="&plus; Assign & Add Another" title="Assign & Add" />
          <input type="button" class="btn btn-success add" id="assign" name="assign"  value="&#10004; Assign Task & Close" title="Assign & Close" />
     </div>

     </div></fieldset>
     </form>
     <div id="display">
          <table style='border-collapse:collapse;border-spacing:0;width: 100%;'>

          </table>
     </div>
      </div>
    </div>
  </div>
</div>
<div id="cnfrm" class="alert alert-primary">
<strong>Assigned Task is Completed !</strong><br>
<div align="center">
<button id="yesbtn" class="btn btn-success" style="padding:5px 22px"> Yes</button>
<button id="nobtn" class="btn btn-danger" style="padding:5px 22px">No</button></div>
</div>
<div id="filter_div" style="border:1px solid #ccc;display:none;margin-top:20px">
<?php 
$provider = sqlStatement("SELECT id,username FROM `users` WHERE authorized = 1 ");
$patient = sqlStatement("SELECT pid,fname,lname FROM `patient_data`");

?>
<form method='post' name='filter_form' id="filter_form">
     <div  class="form-row">
     <div class="forms col-md-3">
          <label><?php echo xlt('Assign To'); ?></label><br>
               <select class="form-control" title="Choose Provider" name="userfilter" id="userfilter"
               >
                    <?php 
              
                    while($row = sqlFetchArray($provider)){?>
                         <option id="<?php echo $row['id'] ?>" value="<?php echo $row['username'] ?>"><?php echo $row['username'] ?></option>
                         <?php }
                    ?>
               </select>
               
     </div>
     <div class="forms col-md-3">
          <label><?php echo xlt('Patient'); ?></label><br>
          <select class="form-control" title="Choose Patient" name="patfilter" id="patfilter">
               <option value="">-- Select Patient -- </option>
               <?php 
                    while($row = sqlFetchArray($patient)){?>
                         <option id="<?php echo $row['pid'] ?>" value="<?php echo $row['pid'] ?>|<?php echo $row['fname']." ".$row['lname'] ?>"><?php echo $row['fname']." ".$row['lname']." [".$row['pid'] ."]"?></option>
                         <?php }
                    ?>
          </select>
               
     </div>
     <div class="forms col-md-3">
          <div  style="display:inline;float:right;padding-top: 25px;">
               <input type="hidden" id="fill" name="fill" value="1" />
               <input type="submit" class="btn btn-success" id="filter" name="filter" value="Filter" />
               <input type="button" id="close" class="btn btn-danger" value="Close" />
          </div>

     </div>
     </div>
</form>
</div>
     <br><hr>
<div class="task_table" id="task_table" style='text-align:center;'>
     
<?php 
$query ="SELECT t.*,CONCAT(p.fname,' ',p.lname) as pat_name, u.fname as ufname,u.lname as ulname ,f.encounter as enc FROM `task_manager` as t join `form_encounter` as f on t.enc_id = f.id join `users` as u on t.uid=u.id join `patient_data` as p on p.pid = t.pid ";
$query1 = "SELECT * FROM `task_manager` WHERE enc_id ='' ";
$tablealert = 0;
$qry = "";
     
     if($_POST['archive']!='' || $_POST['archive']!=NULL){
      $qry = $query." WHERE t.archive='Archived' ";
      $qry .="  ORDER BY t.new_status DESC";
      $query1 .= " AND archive='Archived' ORDER BY new_status DESC";
     }
     else if(isset($_POST['userfilter'])){
          $user =$_POST['userfilter'];
          $pat =$_POST['patfilter'];

          $qry = $query." WHERE t.assigned_to='$user'";

               if($pat !=""){
                    $pat =explode('|',$_POST['patfilter']);
                    $pat = $pat[1];

                     $qry.="  and t.pname = '$pat'"; 
               }
          $qry .=" and t.archive!='Archived'";
          $qry .="  ORDER BY t.new_status ASC";

     }
     $query .=" WHERE t.archive != 'Archived'";
     // $query .="  ORDER BY t.new_status DESC";
     $query1 .= " AND archive !='Archived' ORDER BY new_status DESC";
// print_r($query);
     if($qry==""){
          $sqltask = sqlStatement($query);
          $sqltask1 = sqlStatement($query1);
     }else{
          $sqltask = sqlStatement($qry);
         // $sqltask1 = sqlStatement($qry);
     }
     $data = array();
     // print_r($sqltask);die;

     $n =0;
     for ($i = 0; $rowz = sqlFetchArray($sqltask); $i++) {
          $data[$i] = $rowz;
          $n=$i;
     }
     if($qry==""){
          $n = $n+1;

          for ($i = $n; $rowz = sqlFetchArray($sqltask1); $i++) {          
               $data[$i] = $rowz;
          }

     }
     if (!empty($data)) {
        ?>
        <table class="table table-sm table-hover w-100" id="mymaintable">
        <thead class="table-primary">
            <tr style="padding:10px;">
                <td align='center' style='padding:5px;display:none'><?php echo xlt('ID'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Assigned By'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Patient Name'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Encounter ID'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Assigned To'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Task'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Assigned Date'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Start Date'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('End Date'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Status'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Update Status'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Reassign/Reopen'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Edit'); ?></td>
                <td align='center' style='padding:5px;'><?php echo xlt('Archive'); ?></td>
                <td align='center' style='padding:5px;display:none'><?php echo xlt('Demo'); ?></td>
            </tr>
          </thead><tbody id="tbody">
          <?php
          $class='';
          $btn='';
          $btn2='';

          foreach ($data as $key => $value) {
               $btn2 ="<input type='button' class='btn btn-info text-white archive' name='' id=".$value['id']." value='Archive' style='background-color: #4e4d4d;'>";
               if($value['archive']=="Archived"){
                    $btn2="<input type='button' class='btn btn-dark unarchive' name='unarchive' id='".$value['id']."' value='Unarchive'>";
               }
          
               if($value['status']!="Completed"){
               
               if((($value['status']=="Assigned") || ($value['status']=="Reassigned") || ($value['status']=="Archived") || ($value['status']=="Reopened")) && ($value['end_date']>=date('Y-m-d'))) {
                         $class = "alertsuccess";
                         $btn ="<input type='button' class='btn btn-success taskbtn' name='' id='".$value['id']."' value='Set as Completed'>";
                         $btn0 ="<input type='button' class='btn btn-success editbtn' name='' id='".$value['id']."' value='Edit' style='background-color: crimson;'>";
                         if($value['pid']!=''){
                         $btn1 ="<input type='button' class='btn btn-primary re_assign' name='' id='".$value['id']."' value='Re-Assign Task'>";
                         }else{
                              $btn1 ='';  
                         }
               }else if((($value['status']=="Assigned") || ($value['status']=="Reassigned") || ($value['status']=="Reopened")) && ($value['end_date']<date('Y-m-d'))){
                         $btn="<b style='color:red'>Completed</b>";
                         $class = "alerttask";     
                         $btn ="<input type='button' class='btn btn-success taskbtn' name='' id='".$value['id']."' value='Set as Completed'>";
                         $btn0 ="<input type='button' class='btn btn-success editbtn' name='' id='".$value['id']."' value='Edit' style='background-color: crimson;'>";
                         if($value['pid']!=''){
                         $btn1 ="<input type='button' class='btn btn-primary re_assign' name='' id='".$value['id']."' value='Re-Assign Task'>";
                         }else{
                              $btn1 ='';  
                         }
                    }
               }
               else{
                    $btn0='';
                    $class = "alertdone";
                    $btn =$value['status'];
                    $btn1 ="<input type='button' class='btn btn-danger re_open' name='' id='".$value['id']."' value='Re-Open Task'>";
               
               }
               $enc_id = $value['pid'];
               $enc_date = sqlquery("SELECT date as encdate FROM `form_encounter` where id = '$enc_id'");
               $name = getPatientData($value['pid'], "fname, mname, lname, pubpid, billing_note, DATE_FORMAT(DOB,'%Y-%m-%d') as DOB_YMD");
               $age = getPatientAge($name['DOB_YMD']);
          // return $age;
               $result4 = sqlStatement(
                    "SELECT fe.encounter,fe.date,fe.billing_note,openemr_postcalendar_categories.pc_catname FROM form_encounter AS fe " .
                    " LEFT JOIN openemr_postcalendar_categories ON fe.pc_catid=openemr_postcalendar_categories.pc_catid  WHERE fe.pid = ? ORDER BY fe.date DESC",
                    array(
                         $value['pid']
                    )
               );
               
          ?>
          <script>
               Count = 0;
          <?php if($value['pid'] ==''){ 
               ?>
          EncounterDateArray[<?php echo attr($value['pid']); ?>] = new Array;
          CalendarCategoryArray[<?php echo attr($value['pid']); ?>] = new Array;
          EncounterIdArray[<?php echo attr($value['pid']); ?>] = new Array;
          <?php
               while ($rowresult4 = sqlFetchArray($result4)) {
                    ?>
                    EncounterIdArray[<?php echo attr($value['pid']); ?>][Count] = <?php echo js_escape($rowresult4['encounter']); ?>;
                    EncounterDateArray[<?php echo attr($value['pid']); ?>][Count] = <?php echo js_escape(oeFormatShortDate(date("Y-m-d", strtotime($rowresult4['date'])))); ?>;
                    CalendarCategoryArray[<?php echo attr($value['pid']); ?>][Count] = <?php echo js_escape(xl_appt_category($rowresult4['pc_catname'])); ?>;
                    
                    Count++;
                    <?php 
          }  }?>
               
          </script>


            <tr class="<?php echo $class ?>" style="padding:12px">
                <td align='center'  style='vertical-align: middle;padding:4px;display:none'><?php echo text($value['id']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo text($value['assigned_by']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo text($value['pat_name']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><a onclick="encvisit('<?php echo text($value['pid']); ?>','<?php echo text($name['pubpid']); ?>','<?php echo text($value['pname']); ?>','<?php echo text($value['enc']); ?>', '<?php echo oeFormatShortDate($enc_date['encdate']); ?>' , 'DOB  : <?php echo text($name['DOB_YMD']); ?> Age : <?php echo text($age); ?>')" > <?php echo text($value['enc']); ?></a></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo text($value['ufname'].' '.$value['ulname']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;text-align: justify;'><?php echo text($value['task']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo text($value['date']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo text($value['start_date']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo text($value['end_date']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo text($value['status']); ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo $btn; ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo $btn1; ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo $btn0; ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;'><?php echo $btn2; ?></td>
                <td align='center'  style='vertical-align: middle;padding:4px;display:none'><?php echo ($value['new_status']); ?></td>
            </tr>
            <?php
        }
        ?></tbody>
        </table>
        <div id='tablediv'></div>
        <?php
    }else{
     print_r(10);
     ?>
    <script> $("#task_table").html("<label class='h4'>No Task Available!</label>");</script>
     <?php } ?>
    </div>
    <!-- ---div over--- -->
</div>
</div>
</div>
</body>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="../tab/js/tab_view_model.js"></script> -->
<script>
     $(".retask").on('click',()=>{
          $('#myModal').modal();
     });
     var patient;
     var arr=new Array();

function sel_patient() {
    let title = '<?php echo xlt('Patient Search'); ?>';
    dlgopen('../../main/calendar/find_patient_popup.php', 'findPatient', 650, 300, '', title);
}
function sel_provider() {
    let title = '<?php echo xlt('User Search'); ?>';
    dlgopen('provider_find.php', 'findProvider', 650, 300, '', title);
}
function setpatient(pid, lname, fname, dob) {
    var f = document.forms[0];
    $('#patlist').val(fname + ' ' + lname);
    $('#pids').val(pid);
    pid_enc(pid);
}
function setprovider(name,uid) {
    var f = document.forms[0];
    $('#userslist').val(name);
    $('#uids').val(uid);
}

function alertdiv(data){
   
     $('.success1').css('display','block');
     $('div.success1' ).html(data);
     $( "div.success1" ).delay( 2000 ).fadeOut( 400 );
     setTimeout(location. reload. bind(location), 3000);
}

$('#filter_btn').click(function(){
     $('#filter_div').css('display','block');
})

$('#close').click(function(){
     $('#filter_div').css('display','none');
})
    // DataTable
$(document).ready(function () {

     var rowcount = 0;
    // Setup - add a text input to each footer cell
    $('#mymaintable thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#mymaintable thead');
 
    var table = $('#mymaintable').DataTable({
     
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters td').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters td').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                         //   // $(this)
                         //        .focus()[0]
                         //        .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        aaSorting : [[0, 'desc']],
        "columnDefs": [
    { "width": "17%", "targets": 5 }
  ],
     "stripeClasses": []
    });
    
}); 

        $('#mymaintable').on('mouseenter', 'tbody tr', function() {
            $(this).find('a').css('text-decoration', 'underline');
        });
        $('#mymaintable').on('mouseleave', 'tbody tr', function() {
            $(this).find('a').css('text-decoration', '');
});




var id;

     $(".taskbtn").click(function(){
          $( "#cnfrm" ).css('display','block');
        id  = $(this).attr('id');
        
          $("#yesbtn").val(id);
     })
     

     $(".re_open").click(function(){
        id  = $(this).attr('id');
        $.ajax({  
                    type: 'POST',  
                    url: 'task.php', 
                    data: { update_id: id },
                    success: function(response) {
                         alertdiv(response);
                   
                    }
               });         
     })
     
     $(".re_assign").click(function(){
        id  = $(this).attr('id');
        $.ajax({  
          type: 'POST',  
          url: 'task.php', 
          data: { new_id: id },
          success: function(response) {
               var data = jQuery.parseJSON(response);
               var data = data['fields'];
               // console.log(data);
              // var patvalue =data['pid']+'|'+data['pname'];
               $('#userslist').val(data['assigned_to']);
               $('#uids').val(data['uid']);
               $("#patlist").val(data['pname']);
               $("#pids").val(data['pid']);
              
               $enc =data["enc_id"];
               patlistChange($enc);
              $('#sdate').val(data['start_date']);
              $('#edate').val(data['end_date']);
              $('#task').val(data['task']);
              $('#hidden').val(data['id']);
              setTimeout(function(){
              $("#enc").val(data["enc_id"])}, 1500);
              $("#myModal").modal();
              $(".modal-title").text("Re-Assign Task");
              $("#add").css("display","none");
                    }
               });         
     });
          $(".editbtn").click(function(){
          
        id  = $(this).attr('id');
        $.ajax({  
          type: 'POST',  
          url: 'task.php', 
          data: { edit: id },
          success: function(response) {
               var data = jQuery.parseJSON(response);
               var data = data['fields'];
                
              // var patvalue =data['pid']+'|'+data['pname'];
               $('#userslist').val(data['assigned_to']);
               $("#patlist").val(data['pname']);
               $("#pids").val(data['pid']);
               $("#uids").val(data['uid']);
              
               $enc =data["enc_id"];
               patlistChange($enc);
              $('#sdate').val(data['start_date']);
              $('#edate').val(data['end_date']);
              $('#task').val(data['task']);
              $('#edit').val(data['id']);
              setTimeout(function(){
              $("#enc").val(data["enc_id"])}, 1500);
              $('#myModal').modal();
              $('.modal-title').text("Edit Task");
              $("#add").css("display","none");
                    }
               });         
     });
     $(".archive").click(function(){
        id  = $(this).attr('id');
        $.ajax({  
                    type: 'POST',  
                    url: 'task.php', 
                    data: { archive_id: id },
                    success: function(response) {
                         alertdiv(response);
                         $(id).css('display','none');
                    }
               });         
     })

     $(".unarchive").click(function(){
        id  = $(this).attr('id');
        $.ajax({  
          type: 'POST',  
          url: 'task.php', 
          data: { unarchive_id: id },
          success: function(response) {
               alertdiv(response);
                         $(id).css('display','none');
                    }
               });         
     });

     $("#yesbtn").click(function(){
          $( "#cnfrm" ).css('display','none');
          var id = $("#yesbtn").val();
               $.ajax({  
                    type: 'POST',  
                    url: 'task.php', 
                    data: { id: id },
                    success: function(response) {
                         alertdiv(response);
                    }
               });         
     })

     $("#nobtn").click(function(){
          $( "#cnfrm" ).css('display','none');

     })

     function encvisit(pid, pubpid, pname, enc, datestr, dobstr){
         // console.log(pid, pubpid, pname, enc, datestr, dobstr);
         // var url='../../patient_file/encounter/encounter_top.php?set_encounter=' + encId;
               window.toencounter(pid, pubpid, pname, enc, datestr, dobstr);
              // parent.left_nav.setPatientEncounter(EncounterIdArray[pid],EncounterDateArray[pid], CalendarCategoryArray[pid]);

     }

     function toencounter(pid, pubpid, pname, enc, datestr, dobstr) {
          
     console.log(EncounterIdArray)
            top.restoreSession();
            encurl = 'patient_file/encounter/encounter_top.php?set_encounter=' + encodeURIComponent(enc) +
                '&pid=' + encodeURIComponent(pid);
                parent.left_nav.setPatient(pname, pid, pubpid, '', dobstr);
                parent.left_nav.setEncounter(datestr, enc, 'enc');
                parent.left_nav.loadFrame('enc2', 'enc', encurl);
     }
var flag=0;

$('.addtask').click(function(){

     $('#edit').val('');
     $('#hidden').val('');
     $('#enc').val(''); 
     $("#patlist").val('');
     $("#myModal").modal();
     $(".modal-title").text("Add Task");
     $("#add").css("display","inline");
});


$("#assign").click(function(e){
     flag=1;
     $("#add").trigger("click");          
})

$("#add").click(function(e){
     var task,edate,enc,patname,patid,user,hidden,hidden2,num=1;
     user = $("#userslist").val();
patname = $("#patlist").val();
patid = $("#pids").val();

enc = $("#enc").val();
sdate = $("#sdate").val();
edate = $("#edate").val();
task = $("#task").val();
hidden=$('#hidden').val();
hidden2=$('#edit').val();

     if(flag==0)
     {
         console.log(user,pat,enc,sdate,edate,task);
          if(!user||!sdate||!task){
               e.preventDefault();
               $(".modal-header i").html(' ** All Fields are Mandatory!');
               
          }else{
               this.form.reset();

            if(patname){   
               //patname = pat.split('|');

               $("#enc option").remove();
               $("#display table").append("<tr id='row_"+num+"'><td><input type='hidden' class='userslist' value='"+user+"'>"+user+"</td><td><input type='hidden' class='pat' value='"+patname+"'>"+patname+"</td><td><input type='hidden' class='pat1' value='"+patid+"'>"+patid+"</td><td><input type='hidden' class='enc' value='"+enc+"'>"+enc+"</td><td><input type='hidden' class='sdate' value='"+sdate+"'>"+sdate+"</td><td><input type='hidden' class='edate' value='"+edate+"'>"+edate+"</td><td><input type='hidden' class='task' value='"+task+"'>"+task+"</td><input type='hidden' class='hidden' value='"+hidden+"'><input type='hidden' class='hidden2' value='"+hidden2+"'></tr>");
            }
            else{
               $("#display table").append("<tr id='row_"+num+"'><td><input type='hidden' class='userslist' value='"+user+"'>"+user+"</td><td><input type='hidden' class='pat' value=''></td><td><input type='hidden' class='pat1' value=''></td><td><input type='hidden' class='enc' value=''></td><td><input type='hidden' class='sdate' value='"+sdate+"'>"+sdate+"</td><td><input type='hidden' class='edate' value='"+edate+"'>"+edate+"</td><td><input type='hidden' class='task' value='"+task+"'>"+task+"</td><input type='hidden' class='hidden' value='"+hidden+"'><input type='hidden' class='hidden2' value='"+hidden2+"'></tr>");
            }
          $("#patlist").val("");
          var dtToday = new Date();

          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();
          if(month < 10)
          month = '0' + month.toString();
          if(day < 10)
          day = '0' + day.toString();
          var maxDate = year + '-' + month + '-' + day;
          $('#sdate').attr('min', maxDate);
          $('#edate').attr('min', maxDate);

          $('#sdate').val(maxDate);
          var date = $('#sdate').val();
          $('#edate').val(date);


          $('#sdate').change(()=>{
          var date = $('#sdate').val();
          $('#edate').val(date);
          });
          } 
     }else{

          if(!user||!sdate||!task){
               e.preventDefault();
               $(".modal-header i").html(' ** Fill Mandatory Fields!');
          }else{
               this.form.reset();

               $("#enc option").remove();
               $("#display table").append("<tr id='row_"+num+"'><td><input type='hidden' class='userslist' value='"+user+"'>"+user+"</td><td><input type='hidden' class='pat' value='"+patname+"'>"+patname+"</td><td><input type='hidden' class='pat1' value='"+patid+"'>"+patid+"</td><td><input type='hidden' class='enc' value='"+enc+"'>"+enc+"</td><td><input type='hidden' class='sdate' value='"+sdate+"'>"+sdate+"</td><td><input type='hidden' class='edate' value='"+edate+"'>"+edate+"</td><td><input type='hidden' class='task' value='"+task+"'>"+task+"</td><input type='hidden' class='hidden' value='"+hidden+"'><input type='hidden' class='hidden2' value='"+hidden2+"'></tr>");
               $("#patlist").val("");
               $('#sdate').val(maxDate);
               $('#edate').val(maxDate);
          var userslist = [];
          var pat = [];
          var pat1 = [];
          var uid = [];
          var enc = [];
          var sdate = [];
          var edate = [];
          var task = [];
          var hidden=[];
          var hidden2=[];

          $('.userslist').each(function(){
               userslist.push($(this).val());
          });
          $('.pat').each(function(){
               pat.push($(this).val());
          });
          $('.pat1').each(function(){
               pat1.push($(this).val());
          });
          $('.uids').each(function(){
               uid.push($(this).val());
          });
          $('.enc').each(function(){
               enc.push($(this).val());
          });
          $('.sdate').each(function(){
               sdate.push($(this).val());
          });
          $('.edate').each(function(){
               edate.push($(this).val());
          });
          $('.task').each(function(){
               task.push($(this).val());
          });
          $('.hidden').each(function(){
               hidden.push($(this).val());
          });
          $('.hidden2').each(function(){
               hidden2.push($(this).val());
          
          });
     //     alert(userslist);
                    $.ajax({  
                              type: 'POST',  
                    url: 'task.php', 
                    data: { user: userslist,
                         pat: pat,
                         pat1: pat1,
                         uid:uid,
                         enc: enc,
                         sdate: sdate,
                         edate: edate,
                         task: task,
                         hidden:hidden,
                         hidden2:hidden2,
                         assign_new:"assign_new"
                    },
                    success: function(response) {

                         $('#myModal').modal('hide');
                         alertdiv(response);
                    }
               });
   } 
     }
     
     
   });
// $("#filter").click(function(){
//           var pat,user;
//      user = $("#userfilter").val();
//      pat = $("#patfilter").val();
//      pat = pat.split('|');
    
//      $.ajax({  
//           type: 'POST',  
//           url: 'task.php', 
//           data: { 
//                userfilter: user,
//                patfilter: pat[1],
//                form:"filter"
//           },
//           success: function(data) {
//                alert(data);
//                //$('#mymaintable').css('display','none');

               
//                $('tbody').html(data);
//                response.preventDefault();
             
//           }
//      });
// });
// $('#task').blur(function(){
//      var task,edate,enc,pat,user;
//           user = $("#userslist").val();
//      pat = $("#patlist").val();
//      enc = $("#enc").val();
//      sdate = $("#sdate").val();
//      edate = $("#edate").val();
//      task = $("#task").val();
//         if(!user||!pat||!enc||!sdate||!edate||!task){
//           e.preventDefault();
//           alert(' ** All Fields are Mandatory!');
//          // alert('required inputs');
//         }else{
//           $('.add').attr('disabled',false);  
//         }
// })


function pid_enc(pid){
     //alert(1);
     patient = $('#pids').val();
     $('#enc').html('');
     $.ajax({   
                    type: 'POST', 
                    url: 'task.php', 
                    data: { patid: patient },
                    success:function(response){
                    var data = jQuery.parseJSON(response);
                    var count = data.length;
               if(count>0){
                    $('#enc_alert').css('display','none');
                    jQuery.each(data, function(key,value){
                         var date = value['date'].split(" ");
                    $('#enc').append('<option id='+value['id']+' value='+value['id']+'>'+date[0]+' '+value['name']+'</option>');
                    
                    $('.add').attr('disabled',false);
                    });
               }else{
                    // $('#enc_alert').css('display','block');
                    // $('#enc_alert').html('* Create a new Encounter!');
                    // $('.add').attr('disabled',true);
               }
                }
               });

};

function patlistChange($enc){
          patient = $("#pids").val();
          $('#enc').html('');
          $.ajax({  
               type: 'POST',  
               url: 'task.php', 
               data: { patid: patient },
               success:function(response){
                    var data = jQuery.parseJSON(response);
                    var count = data.length;
                    if(count>0){
                         $('#enc_alert').css('display','none');
                         jQuery.each(data, function(key,value){
                              var date = value['date'].split(" ");
                         if($enc == value['id'] ){
                         $('#enc').append('<option id='+value['id']+' value='+value['id']+' selected>'+date[0]+' '+value['name']+'</option>');
                    }else{
                         $('#enc').append('<option id='+value['id']+' value='+value['id']+'>'+date[0]+' '+value['name']+'</option>');
                    }
                         $('.add').attr('disabled',false);
                         });
                    }else{
                         // $('#enc_alert').css('display','block');
                         // $('#enc_alert').html('* Create a new Encounter!');
                         // $('.add').attr('disabled',true);
                    }
               }
          });
}

$('#filter_btn').click(function(){
     
})

$(document).ready(function(){

 // Initialize select2

 let trigger_addtask = localStorage.getItem("trigger_addtask");
 if(trigger_addtask){
     $("#myModal").modal();
     localStorage.removeItem("trigger_addtask");
 }

var dtToday = new Date();

var month = dtToday.getMonth() + 1;
var day = dtToday.getDate();
var year = dtToday.getFullYear();
if(month < 10)
    month = '0' + month.toString();
if(day < 10)
 day = '0' + day.toString();
var maxDate = year + '-' + month + '-' + day;
$('#sdate').attr('min', maxDate);
$('#edate').attr('min', maxDate);

$('#sdate').val(maxDate);
var date = $('#sdate').val();
$('#edate').val(date);
});

$('#sdate').change(()=>{
 var date = $('#sdate').val();
$('#edate').val(date);
});
$(".close").click(()=>{
$("#assign_form")[0].reset();
$('#edate').val(date);
});
</script>
</html>