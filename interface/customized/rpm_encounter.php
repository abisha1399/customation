<?php
 //require_once("../globals.php");
require_once(__DIR__ . '/../globals.php');
require_once($GLOBALS["srcdir"] . "/api.inc");
function bill_create($code,$pid,$encounter){
    $code_text='rpm encounter billing code';
            $modifier='';
            $units='';
            $ndc_info = '';
            $justify = '';
            $billed = 0;
            $notecodes = '';
            $pricelevel = '';
            $revenue_code = "";
            $code_type='CPT4'; 
            $units='1';
            $fee='100'; 
            $sql = "INSERT INTO billing (date, encounter, code_type, code, code_text, " .
            "pid, authorized, user, groupname, activity, billed, provider_id, " .
            "modifier, units, fee, ndc_info, justify, notecodes, pricelevel, revenue_code) VALUES (" .
            "NOW(), ?, ?, ?, ?, ?, ?, ?, ?,  1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insert_id=sqlInsert($sql, array($encounter, $code_type, $code,$code_text, $pid, 1,1, 'Default', 0, 1, $modifier, $units, $fee,$ndc_info, $justify, $notecodes, $pricelevel, $revenue_code));
            return $insert_id;
}
if(isset($_GET['rpm_encounter'])){
    $pid=$_POST['pid'];
    if($pid ==''){
        $pid=$_SESSION['pid'];
    }else{
        $pid=$_POST['pid'];
    }
    $eid=isset($_SESSION['encounter'])?$_SESSION['encounter']:'';
    // if($eid==''){
        $eid_array=sqlQuery("SELECT * FROM form_encounter WHERE pid=? AND date_end!='' AND encounter_status='open'",array($pid));
        $eid=isset($eid_array['encounter'])?$eid_array['encounter']:'';
    //}
    $encounter_type=$_POST['encounter_type'];
    $performed_by=$_POST['performed_by'];
    $activity=$_POST['activity'];
    $note=$_POST['note'];
    $timespent=$_POST['timespent'];
    $date=date('Y-m-d h:i:s');
    $sql = sqlInsert("INSERT INTO rpm_encounter(pid,eid,encounter_type,performed_by,activity,timespent,notes,date) VALUES (?,?,?,?,?,?,?,?)",array($pid,$eid,$encounter_type,$performed_by,$activity,$timespent,$note,$date));
    echo $sql;exit;
}
if(isset($_GET['edit_rpm'])){
    $id=$_POST['id'];
    $encounter_type=$_POST['encounter_type'];
    $performed_by=$_POST['performed_by'];
    $activity=$_POST['activity'];
    $note=$_POST['note'];
    $timespent=$_POST['timespent'];
    $current_datetime = date('Y-m-d H:i:s');
    sqlStatement("UPDATE rpm_encounter SET encounter_type=?,performed_by=?,activity=?,timespent=?,notes=?,date=? WHERE id=?",array($encounter_type,$performed_by,$activity,$timespent,$note,$current_datetime,$id));
    echo $id;
    exit();
}

if(isset($_GET['delete_enc'])){
    $id=$_POST['id'];
    sqlStatement("UPDATE rpm_encounter SET is_deleted=1 WHERE id=?",array($id));
    exit();
}

if(isset($_GET['get_rpmenc'])){
    $id=$_POST['id'];
    if($id!=''){
        $rpm_encounter_array=sqlQuery("SELECT * FROM rpm_encounter WHERE id=?",array($id));
        $login_id=isset($_SESSION['authUserID'])?$_SESSION['authUserID']:'1';
        $perform_id=isset($rpm_encounter_array['performed_by'])?$rpm_encounter_array['performed_by']:$login_id;
       // echo $perform_id;exit();
        // $users_data=sqlStatement("SELECT * FROM users WHERE active=1");
        $authuserid=isset($_SESSION['authUserID'])?$_SESSION['authUserID']:'1';
        $users_data=sqlStatement("SELECT * FROM users WHERE id='$authuserid'");
        $select='<select name="performed_by" class="form-control" id="performed_by">';
                           
            while($row=sqlFetchArray($users_data)){
                               
                $user_name=$row['fname']. ' '.$row['lname'];
                $select.='<option value="'.$row['id'].'"';
                if($row['id']==$perform_id){                    
                    $select.='selected';
                }
                $select.='>'.$user_name.'</option>';
            }
                       
        $select.='</select>';
        $result['rpm_encounter_data']=$rpm_encounter_array;
        $result['select']=$select;
        echo json_encode($result);
        
    }
    
    exit();
}


if(isset($_GET['rpm_bill_generate'])){
    $result='no code create';
    $pid=isset($_POST['pid'])?$_POST['pid']:'';
    $encounter=isset($_POST['encounter'])?$_POST['encounter']:'';
   
    $sum_query=sqlQuery("SELECT SUM(timespent) as duration from rpm_encounter WHERE pid=? and eid=? and is_deleted=0",array($pid,$encounter));
    $duration=isset($sum_query['duration'])&&$sum_query['duration']!='NULL'?$sum_query['duration']:0;
    sqlStatement("DELETE FROM billing WHERE encounter=? AND code_text='rpm encounter billing code'",array($encounter));
    
    if($duration >= 20 && $duration < 40)
    {
        $code=99457;               
        $bil_event=bill_create($code,$pid,$encounter);
        $result='bill  code 99457 created';
    }
    elseif(($duration >= 40))
    { 
        
        $code1=99457;
        $code=99458;
        bill_create($code1,$pid,$encounter);
        $bil_event=bill_create($code,$pid,$encounter);
        $result='bill  code 99457,99458 created';
    }
    echo $result;  
    exit();  
}
function rpm_encounter_div(){
    $result='<button class="btn btn-secondary btn-sm" id="click_new" type="button" style="display:none;" data-bind="click: rpmNewEncounter" >
    <span><?php echo xlt("RPM Encounter");?></span>
    </button>
        
    <div id="rpm_form">
        <div>
                <h4 id="rpm_header" class="bg-secondary text-light pt-1 pb-1" style="display:inline-flex;width:100%">
                    <span style="margin-left:10px">Record Encounter</span>
                    <span style="float:right;margin-left:100px;padding-left:70px;">'.date("F d, Y h.ia").'</span>
                </h4>
                <form action="" style="padding: 6px 30px;">
                    <div class="row" >
                        <input type="hidden" id="rpm_enc_id">
                        <input type="hidden" id="pid" value = '.$_SESSION["pid"].'>
                        <input type="hidden" name="encounter_type" id="encounter_type">
                        <div class="col-12">
                            <div style="display:flex;">                
                            <div>
                                Encounter Type :
                            </div> 
                            <div style="display:flex" class="ml-2">
                                <div class=""> <input type="button" id="Phone_Call" name="phone_call" value="Phone Call" class="form-control encounter_type"> </div>
                                <div class="ml-1"> <input type="button" id="Chart_View" name="chart_view" class="form-control encounter_type" value="Chart View"> </div>
                            </div> 
                            <div style="display:flex;">
                                <div class="pl-4"> Performed by :</div>  
                                <div class="ml-2">';
                                
                                    $authuserid=isset($_SESSION['authUserID'])?$_SESSION['authUserID']:'1';
                                    $login_id=isset($_SESSION['authUserID'])?$_SESSION['authUserID']:'1';
                                    $users_data=sqlStatement("SELECT * FROM users WHERE id='$authuserid' ");


                                    
                                $result.='<select name="performed_by" class="form-control" id="performed_by">';
                                        
                                    while($row=sqlFetchArray($users_data)){
                                        $selected=isset($row['id'])&&$row['id']==$login_id?'selected':'';
                                        $user_name=$row['fname']. ' '.$row['lname'];
                                        $result.= '<option value='.$row['id'].''.$selected.'>'.$user_name.'</option>';
                                    }
                                    
                            $result.=' </select>
                                </div>
                            </div>
                            </div>     
                        </div>
                    
                    </div>
                    <br>
                    <div class="row" >
                        <input type="hidden" name="activity" id="activity" >
                        <div style="display:flex;">
                            <div class="col-3">Activity :</div>
                            <div class="col-9">
                                <div style="display:flex;">
                                    <div class=""><input type="button" id="pghd" name="pghd" value="Review PGHD" class="form-control activity"></div> &nbsp;
                                    <div class=""><input type="button" id="return_call" name="Return Call" value="Return Call" class="form-control activity"></div> &nbsp;
                                    <div class=""><input type="button" id="mediction_refill" name="mediction_refill" value="Mediction Refill" class="form-control activity"> </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <br>
                    <div id="summernote"></div>
                    <br>
                    <div class="row" >
                        <div class="col col-3">Total Time Spent : </div>
                        <div class=""><button type="button" id="2min" value="2" class="form-control time"> 2min</button></div>&nbsp;
                        <div class=""><button type="button" id="5min" value="5" class="form-control time">5min</button></div> &nbsp;
                        <div class=""><button type="button" id="10min" value="10" class="form-control time">10min</button></div> &nbsp;
                        <div class=""><button type="button" id="20min" value="20" class="form-control time">20min</button></div> &nbsp;
                        <div class="col-2 pl-0">
                        <input type="text" id="maxmin" name="maxmin"  placeholder="Others" class="form-control"> </div>
                        <input type="hidden" name="timespent" id="timespent">
                    </div><br>
                    <input type="button" id="confirm" name="confirm" class="btn-primary ml-4" value="Confirm" >       
                    <input type="button" id="rpm_close" name="rpm_close" value="Cancel">
                    <input type="reset" id="clear" class="mr-3" style="float:right" value="clear" onclick="clear_field(1)">
                    <br>
                    <br>
                </form>
        </div>        
    </div>';
    return $result;
}
//edit ecnounter
function encounter_status($encounter){
    $rpm_encounter_query=sqlQuery("SELECT * FROM form_encounter WHERE encounter=?", array($encounter));
    $rpm_Status=isset($rpm_encounter_query['date_end']) && $rpm_encounter_query['date_end']!='NULL'?'true':'false';
    $rpm_editable=isset($rpm_encounter_query['encounter_status'])&&$rpm_encounter_query['encounter_status']=='open'?'true':'false';
    return $rpm_editable;
}
function rpm_encounter_list($encounter)
{   
    $rpm_editable=encounter_status($encounter);    
    $result='';   
    $forms_table=sqlQuery("SELECT * FROM forms WHERE encounter=? AND formdir='newpatient'",array($encounter));
    $form_name=$forms_table['form_name'];
    $form_id=$forms_table['id'];
    $formdir=$forms_table['formdir'];
    $provider_id=$forms_table['authorized'];       
    $providers=sqlQuery("SELECT * FROM users WHERE id=?",array($provider_id));        
    $provider_name=$providers['fname'].' '.$providers['lname'];        
    $result.= '<table style="width:100%" cellpadding="10px" cellspacing="0px">';
    $result.= '<tr style="border-bottom: 1px solid black;" id="' . attr($formdir) . '~' . attr($forms_table['form_id']) . '" class="text onerow">
    <td >
    <div class="form_header">';
    $result.= ' <a href="#" data-toggle="collapse" data-target="#divid_{$div_nums_attr}" class="" id="aid_{$div_nums_attr}">
                    <h5>Visit Summary</h5>
                    by '.$provider_name.'
                </a>';
                
                $result.= "</div><div class='form_header_controls btn-group' role='group'>";
                $result.= "<a class='btn btn-secondary btn-sm form-edit-button btn-edit' " .
                "id='form-edit-button-" . attr($formdir) . "-" . attr($forms_table['id']) . "' " .
                "href='#' " .
                "title='" . xla('Edit this form') . "' " .
                "onclick=\"return openEncounterForm(" . attr_js($formdir) . ", " .
                attr_js('Visit summary') . ", " . attr_js($forms_table['form_id']) . ")\">";
                $result.= "" . xlt('Edit') . "</a>";
                $result.= '<a target="_parent" href="#esign-mask-content" class="esign-button-form btn btn-secondary btn-sm" data-formdir="newpatient" data-formid="'.$forms_table['form_id'].'" data-encounterid="'.$encounter.'"><i class="fa fa-signature"></i>&nbsp;eSign</a>';
                $result.= "<a class='btn btn-secondary btn-sm collapse-button-form' title='" . xla('Expand/Collapse this form') . "' data-toggle='collapse' data-target='#divid_1'>" . xlt('Expand / Collapse') . "</a>";
                $result.= "</div>\n"; // Added as bug fix.

                $result.= "</td>\n";
                $result.= "</tr>";
    
                $result.='</table>';
                $result.= '<table style="width:100%" cellpadding="15px" cellspacing="0px">';
                $result.= '<tr class="text" style="border-bottom: 1px solid black;">
    <th class="border-bottom border-dark">Date</th>
    <th class="border-bottom border-dark">Activity</th>
    <th class="border-bottom border-dark notes_th">Notes</th>
    <th>Performed By</th>
    <th class="border-bottom border-dark">Time Spent(in minute)</th></tr>';
    $rpm_enc=sqlStatement("SELECT * FROM rpm_encounter WHERE eid=? AND is_deleted=0",array($encounter));
    $result1='';
    $icon='';
    //echo "SELECT * FROM rpm_encounter WHERE eid=".$encounter."";exit();
    while($row=sqlFetchArray($rpm_enc)){
        $rid=$row['id'];
        $date = date('d-m-Y h:i A', strtotime($row['date']));
        $activity=$row['activity'];
        $notes=$row['notes'];
        $users=sqlQuery("SELECT * FROM users WHERE id=?",array($row['performed_by']));
        $performd_by=$users['fname'].' '.$users['lname'];            
        $time=$row['timespent'];
        if($rpm_editable=='true'){
            $icon='<i class="fa fa-trash" style="color:#DC3545;" onclick="delete_enc('.$rid.')"></i>&nbsp;&nbsp;<i class="fa fa-pen" onclick="edit_enc('.$rid.')"></i>';
        }
        else{
            $icon='<i class="fa fa-trash" ></i>&nbsp;&nbsp;<i class="fa fa-pen" ></i>'; 
        }
        $notes_count=strlen($notes);
        if($notes_count>100){
            $small = substr($notes, 0, 100);
            $notes=$small.'....';
        }
        $result1.='<tr id="rpmencounter_row_'.$rid.'">
        <td>'.$date.'</td>
        <td>'.$activity.'</td>
        <td style="width:45%;word-wrap:break-word">'.$notes.'</td>
        <td>'.$performd_by.'</td>
        <td style="display:flex"><div style="width:10%">'.$time.' </div>
        <div style="margin-left:60px;">'.$icon.'</div></td></tr>';
    }
    $result.= $result1;
    $result.='</table>';
    return $result;
}

function edit_encounter_modal(){
    $result='<div id="rpm_form1">
        <h4 id="rpm_header" class="bg-secondary text-light pt-1 pb-1" style="display:inline-flex;width:100%">
            <span style="margin-left:10px">Record Encounter</span>
            <span style="float:right;margin-left:100px;padding-left:70px;">'.date("F d, Y h.ia").'</span>
        </h4>
        <form action="" style="padding: 6px 30px;">
            <div class="row" >
                <input type="hidden" id="rpm_enc_id">
                <input type="hidden" name="encounter_type" id="encounter_type">
                <div class="col-12">
                    <div style="display:flex;">                
                    <div>
                        Encounter Type :
                    </div> 
                    <div style="display:flex" class="ml-2">
                        <div class=""> <input type="button" id="Phone_Call" name="phone_call" value="Phone Call" class="form-control encounter_type"> </div>
                        <div class="ml-1"> <input type="button" id="Chart_View" name="chart_view" class="form-control encounter_type" value="Chart View"> </div>
                    </div> 
                    <div style="display:flex;">
                        <div class="pl-4"> Performed by :</div>  
                        <div class="ml-2" id="activity_dropdown">
                        
                        </div>
                    </div>
                    </div>     
                </div>
            
            </div><br>
            <div class="row" >
                <input type="hidden" name="activity" id="activity" >
                <div style="display:flex;">
                    <div class="col-3">Activity :</div>
                    <div class="col-9">
                        <div style="display:flex;">
                            <div class=""><input type="button" id="pghd" name="pghd" value="Review PGHD" class="form-control activity"></div> &nbsp;
                            <div class=""><input type="button" id="return_call" name="return_call" value="Return Call" class="form-control activity"></div> &nbsp;
                            <div class=""><input type="button" id="mediction_refill" name="mediction_refill" value="Mediction Refill" class="form-control activity"> </div>
                        </div>
                    </div>
                </div>
                
            </div><br>
            <div id="summernote1"></div>
            <br>
            <div class="row" >
                <div class="col col-3">Total Time Spent : </div>
                <div class=""><button type="button" id="2min" value="2" class="form-control time">2 mins </button></div>&nbsp;
                <div class=""><button type="button" id="5min" value="5" class="form-control time">5 mins</button></div> &nbsp;
                <div class=""><button type="button" id="10min" value="10" class="form-control time">10 mins</button></div> &nbsp;
                <div class=""><button type="button" id="20min" value="20" class="form-control time">20 mins</button></div> &nbsp;
                <div class="col-2 pl-0">
                <input type="text" id="maxmin" name="maxmin"  placeholder="Others" class="form-control"> </div>
                <input type="hidden" name="timespent" id="timespent">
            </div><br>
            <input type="button" id="confirm1" name="confirm" class="btn-primary ml-4" value="Confirm" >
        
            <input type="button" id="rpm_close" name="rpm_close" value="Cancel">
            <input type="reset" id="clear" class="mr-3" style="float:right" value="clear" onclick="clear_field(0)">
            <br>
            <br>
        </form>
    </div> ';  
    return $result;
}

function delete_modal_popup(){
    $result='<div class="modal fade" id="authmodel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="width:140% !important;height:150px;">
                <input type="hidden" id="delete_id">
            
            <div class="modal-body" style="height:100px;">
            <b id="error_content"><center>Do You Want to delete?</center></b>
            </div>
            <div class="modal-footer" style="justify-content:center;">
            <div class="mt-3">
                <button type="button" class="btn btn-primary btn-sm" onclick="disconnect();">Yes</button>
            </div>
            <div class="mt-3">
            <button type="button" class="btn btn-danger  btn-sm" data-dismiss="modal">No</button>
            
            </div>
            </div>
        </div>  
    </div>';
return $result;
}

function notes_modal($encounter,$pid)
{          
    $src=$web_root.'/controller.php?document&retrieve&patient_id='.$pid.'&document_id=-1&as_file=false&original_file=true&disable_exit=false&show_original=true&context=patient_picture';
    $error_src=$GLOBALS['images_static_relative'].'/patient-picture-default.png';
    $patient=sqlQuery("SELECT * FROM patient_data WHERE pid=?",array($pid));
    $patientName=$patient['fname'].' '.$patient['lname'];
    
$result='<div class="modal fade" id="modelshow" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header notes">
                <div style="display:flex;">
                    <div>
                    <h4 class="modal-title">Notes</h4>
                    </div>
                    <div style="display:flex" class="right">
                        <div>
                        <h4 class="modal-title">'.$patientName.'</h4>
                        </div>
                        <div>  
                            <img id="image" width="50px" onError=this.setAttribute("src","'.$error_src.'");this.removeAttribute("onError");this.removeAttribute("onclick"); src="'.$src.'">                      
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body">                
                <div class="form-row">';
                    
                    $rpm_enc1=sqlStatement("SELECT * FROM rpm_encounter WHERE eid=? AND is_deleted=0",array($encounter));
                    while($row1=sqlFetchArray($rpm_enc1)){
                        $users1=sqlQuery("SELECT * FROM users WHERE id=?",array($row1['performed_by']));
                        $performd_by1=$users1['fname'].' '.$users1['lname'];  
                        $notes1=$row1['notes'];
                        $date1 = date('d-m-Y h:i A', strtotime($row1['date']));
                                
                    
                    $result.='<div class="forms col-md-7">
                        <article id="art1">
                            <label class="careplan">
                                
                            <label class="content">'.$notes1.'</label>
                            <label class="catherine">'.$performd_by1.'  '.$date1.'</label></label>
                        </article>
                    </div>';
                    
                    }
                                        
                $result.='</div>    
            </div>    
        </div>    
    </div>  
</div>';
return $result;
}

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<style>
    

    #rpm_form1{
    position: absolute;
    width: 650px;
    height: auto;
    /* overflow-x: auto; */
    right: 5px;
    top: 0px;
    z-index: 1000;
    display:none;
    background-color:#fff;

}
#rpm_form{
            position: absolute;
            width: 650px;
            height: auto;
            /* overflow-x: auto; */
            right: 5px;
            top: 201px;
            z-index: 1000;
            display:none;
            background-color:#fff;

        }


        div.tab {
        min-height: 50px;
        padding: 8px;
    }

    div.form_header {
        float: left;
        min-width: 400px;
    }

    div.form_header_controls {
        float: left;
        margin-bottom: 2px;
        margin-left: 6px;
    }

    div.formname {
        float: left;
        min-width: 160px;
        padding: 0;
        margin: 0;
    }

    .encounter-summary-container {
        float: left;
        width: 100%;
    }

    .encounter-summary-column {
        width: 33.3%;
        float: left;
        display: inline;
        margin-top: 10px;
    }

    #sddm {
        margin: 0;
        padding: 0;
        z-index: 30;
    }

    button:focus {
        outline: none;
    }

    button::-moz-focus-inner {
        border: 0;
    }

    .notes{
        height:55px;
        background-color:#6b7cb6;
        
    }
    /* .scroll{
        overflow-y:scroll;
    } */
    
    article{
        border:1px solid black;
        width:762px;
        height:auto;
        margin-bottom:10px;    
    }
    .careplan{
        font-weight:bold;
        margin-left:10px;
        margin-top:7px;

    }
    .test{
        margin-left:545px;
    }
    #image{
        border-radius:100%;
        padding: 4px;
    margin-top: -13px;

    }
    .content{
        font-weight:normal;
        color:black;
    }
    .catherine{
        font-weight:normal;
        margin-left:458px;
    }
    .notes_th{
        cursor: pointer;
    }
    .modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
    overflow-y: auto;
}
.right{
    margin-left: 490px;
}
        .heading {
    text-align: center;
    color: #454343;
    font-size: 30px;
    font-weight: 700;
    position: relative;
    margin-bottom: 70px;
    text-transform: uppercase;
    z-index: 999;
}

.white-heading{
    color: #ffffff;
}
.heading:after {
    content: ' ';
    position: absolute;
    top: 100%;
    left: 50%;
    height: 40px;
    width: 180px;
    border-radius: 4px;
    transform: translateX(-50%);
    background: url(img/heading-line.png);
    background-repeat: no-repeat;
    background-position: center;
}
.white-heading:after {
    background: url(https://i.ibb.co/d7tSD1R/heading-line-white.png);
    background-repeat: no-repeat;
    background-position: center;
}

.heading span {
    font-size: 18px;
    display: block;
    font-weight: 500;
}
.white-heading span {
    color: #ffffff;
}

</style>
    