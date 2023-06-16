<?php

/**
 * external_data.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Vinish K <vinish@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once("$srcdir/patient.inc");
require_once "$srcdir/options.inc.php";
require '../../customized/PHPMailerAutoload1.php';
use OpenEMR\Core\Header;
use OpenEMR\Menu\PatientMenuRole;
use OpenEMR\OeUI\OemrUI;
use OpenEMR\Common\Crypto\CryptoGen;
$patient_data=sqlQuery("SELECT * FROM patient_data WHERE pid=?",array($_SESSION['pid']));
$patient_email=isset($patient_data['email'])?$patient_data['email']:'';
/***tenovi */
if(isset($_GET['tenovi_add_device']))
{
    //echo '<pre>';print_r($_POST);exit();
    $pid=$_POST['pid'];
    $sql = sqlQuery("select phone_home from patient_data where pid = '$pid'");
    $phone = $sql['phone_home']?$sql['phone_home']:'0123243454';
    $device_number_array=$_POST['device_id'];
    $serial_num_error_array=[];
    $add_device_mesage_array=[];
    $response=[];
    if(isset($_GET['type'])&&$_GET['type']=='disconnect')
    {
       
        foreach($device_number_array as $value)
        {
            $device_name=$value['device_name'];
            $exit_device=sqlQuery("SELECT * FROM tenovi_data WHERE device_name='".$device_name."' AND pid=".$pid."");
            
            $device_number=isset($value['device_serial_number'])&&$value['device_serial_number']!=''?$value['device_serial_number']:NULL;
            if($device_number!=''&&$device_number!=NULL)
            {
                $hwi_id=$exit_device['hwi_id'];

            }
            else{
                $hwi_id=NULL;
            }
            $id=isset($exit_device['id'])?$exit_device['id']:'';
            sqlStatement("UPDATE tenovi_data SET device_id='".$device_number."',hwi_id='".$hwi_id."' WHERE id='".$id."'");
           
        } 
        exit();
    }
    foreach($device_number_array as $device_value)
    {
        if($device_value['device_serial_number']!='')
        {
            $already_exit_devices=sqlQuery("SELECT * FROM tenovi_data WHERE pid NOT IN ($pid) AND device_id='".$device_value['device_serial_number']."'");
            
            if(isset($already_exit_devices['device_id'])&&$already_exit_devices['device_id']==$device_value['device_serial_number'])
            {
             $status='error';
             $error_count++;
             $already_exit_devices=$already_exit_devices['device_id'].' device Already Assign to Another Patient!!!';
             $serial_num_error_array[]=$already_exit_devices;
            } 

        }

    }
    if($error_count==0)
    {
        foreach($device_number_array as $device_value)
        {
            $tenovi_device_name = $device_value['device_name'];
            $tenovi_device_id = $device_value['device_serial_number'];
            $message_data=[];
            //sensor code 
            if(str_contains($tenovi_device_name, 'BPM')){
                $sensor_code = '10';
            }else if(str_contains($tenovi_device_name, 'Ox')){
                $sensor_code = '11';
            }else if(str_contains($tenovi_device_name, 'Glucometer')){
                $sensor_code = '12';
            }else if(str_contains($tenovi_device_name, 'Scale')){
                $sensor_code = '13';
            }else if(str_contains($tenovi_device_name, 'Flow')){
                $sensor_code = '17';
            }
            if($tenovi_device_id!='')
            {

                $data1=array(
                    "device"       => array(
                        "name"=> $tenovi_device_name,
                        "hardware_uuid"=> $tenovi_device_id,
                        "sensor_code"=> $sensor_code //'10'
                    ),    
                    "patient_id"    => $pid,
                    "patient_phone_number"  => $phone
                );
                $data=json_encode($data1);
                //echo $data;exit();
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api2.tenovi.com/clients/capminds/hwi/hwi-devices/');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                $headers = array();
                $headers[] = 'authorization: Api-Key XF6mCmsQ.PgoTAFeKBpfSiiTBfR3XOm3O2MtMf1B7';
                $headers[] = 'Cache-Control: no-cache';
                $headers[] = 'Content-Type: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $result = curl_exec($ch);
                $res=json_decode($result,TRUE);    
                if(isset($res['id'])&&$res['id']!=''){
                    $devive_uuid = $res['id'];  
                    $exit_insert_device=sqlQuery("SELECT * FROM tenovi_data WHERE device_name='".$tenovi_device_name."' AND pid='".$pid."'");
                    $exit_id=isset($exit_insert_device['id'])?$exit_insert_device['id']:'';     
                    if($exit_id)
                    {
                        sqlStatement("UPDATE tenovi_data SET device_id=?,hwi_id=?,user_id=? WHERE id=?",array($tenovi_device_id,$devive_uuid,$_SESSION['authUserID'],$exit_id));
                    }
                    else{
                        $query=sqlInsert("INSERT INTO tenovi_data(pid,device_name,device_id,hwi_id,user_id) VALUES (?,?,?,?,?)",array($pid,$tenovi_device_name,$tenovi_device_id,$devive_uuid,$_SESSION['authUserID']));
                    }
                    
                    $message_data['status']='sucess';
                    $message_data['message']=$tenovi_device_name.' '.$tenovi_device_id.' Assigned Successfully';
                    $add_device_mesage_array[]=$message_data;
                }
                else if(str_contains($res['device']['hardware_uuid'][0],'ID already exists'))
                {
                    $exit_insert_device=sqlQuery("SELECT * FROM tenovi_data WHERE device_name='".$tenovi_device_name."' AND pid='".$pid."'");
                    $exit_id=isset($exit_insert_device['id'])?$exit_insert_device['id']:'';     
                    if($exit_id)
                    {
                        sqlStatement("UPDATE tenovi_data SET device_id=?,hwi_id=?,user_id=? WHERE id=?",array($tenovi_device_id,$devive_uuid,$_SESSION['authUserID'],$exit_id));
                    }
                    else{
                        $query=sqlInsert("INSERT INTO tenovi_data(pid,device_name,device_id,hwi_id,user_id) VALUES (?,?,?,?,?)",array($pid,$tenovi_device_name,$tenovi_device_id,$devive_uuid,$_SESSION['authUserID']));
                    }
                    
                    $message_data['status']='success';
                    $message_data['message']=$tenovi_device_name.' '.$tenovi_device_id.' Assigned Successfully';
                    $add_device_mesage_array[]=$message_data;
                    
                }
                else
                {
                    $message_data['status']='error';
                    $message_data['message']=$tenovi_device_name.' Invalid Id';
                    $add_device_mesage_array[]=$message_data;        
                }

            }
        } 
        $response['status']='success';
        $response['message']=$add_device_mesage_array;  


    }
    else{
        $response['status']='error';
        $response['message']=$serial_num_error_array;
        
    }
    
    echo json_encode($response);
    exit();
    

}
/**bodytrace */
function bodytrace_mail($device_number)
{
    //echo '<pre>';print_r($device_number);exit();
    if(!empty($device_number))
    {

        $cryptoGen = new CryptoGen();
        $email_sender='refreshhealthehr@gmail.com';
        $auth_email=isset($GLOBALS['SMTP_USER'])?$GLOBALS['SMTP_USER']:'refreshhealthehr@gmail.com';
        $auth_pass=isset($GLOBALS['SMTP_PASS'])?$GLOBALS['SMTP_PASS']:'adynjudkykinmwcm';
        $site=isset($_SESSION['site_id'])?$_SESSION['site_id']:'';       
        $host=isset($GLOBALS['SMTP_HOST'])?$GLOBALS['SMTP_HOST']:'smtp.gmail.com';
        $port=isset($GLOBALS['SMTP_PORT'])?$GLOBALS['SMTP_PORT']:'587';
        $secure=isset($GLOBALS['SMTP Security Protocol'])?$GLOBALS['SMTP Security Protocol']:'tls';
        define('EMAIL',$auth_email);
		define('PASS',$cryptoGen->decryptStandard($auth_pass));
        $to=isset($GLOBALS['bodytrace_vendor_email'])?$GLOBALS['bodytrace_vendor_email']:'amit@bodytrace.com';               
        $to='maryabisha1399@gmail.com';
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL;                 // SMTP username
        $mail->Password = PASS;                           // SMTP password
        $mail->SMTPSecure = $secure;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $port;  
        $mail->addAddress($to);
        $mail->addReplyTo(EMAIL);
        $mail->SetFrom($email_sender, $email_sender);
        $mail->isHTML(true);
        $mail->Subject = 'Body Trace Integration';
        $data='<p>Hi Amit,</p>'; 
        $imi_list='<ol>'; 
        
        foreach($device_number as $value)
        {
            $imi_list.='<li>'.$value.'</li>';
        }
        $imi_list.='</ol>'; 
        //$imi_list=rtrim($imi_list, ',');            
        $url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://".$_SERVER['SERVER_NAME'].'/apis/'.$site.'/api/bodytracedata';
        $data.='Please find the below details for the configuration of the new body trace devices<br>';
        $data.='IMEI number  : '.$imi_list.'<br>';
        $data.='Endpoint URL :'.$url.'';    
        $data.='<br><br>Thanks,<br>RefreshEhr';
        $mail->Body    = $data;
        if($to)
        {
            $mail->send();
        }

    }
   
}

if(isset($_GET['body_trace_devices'])){
    $pid= $_POST['pid'];
    $user_id=$_SESSION['authUserID'];
    $mail_device_number=[];
    $result=[];
    $status='';
    $error_count=0;
    $serail_number=$_POST['device_number'];
   // echo   $serail_number; exit();
    $device_serailnumber=[];
    $success_count=0;
    // if(!empty($serail_number)){
        foreach($serail_number as $key=>$value)
        {
            if($value['device_serial_number']!=''){
                $success_count++;
            $already_exit_device1=sqlQuery("SELECT * FROM body_trace_number WHERE pid NOT IN ($pid) AND device_number='".$value['device_serial_number']."'");
            }
            if(isset($already_exit_device1['device_number'])&&$already_exit_device1['device_number']==$value['device_serial_number'])
           {
            $status='error';
            $error_count++;
            $exit_serial_number1=$already_exit_device1['device_number'].' device Already Assign to Another Patient!!!';
            $device_serailnumber[]=$exit_serial_number1;
           }
        
           else{               
                
                $type=sqlQuery("SELECT * FROM body_trace_number WHERE device_model='".$value['device_model']."' AND pid=".$pid."");
                $id=isset($type['id'])?$type['id']:0;
                if($id)
                {
                    Sqlstatement("UPDATE body_trace_number SET device_number='".$value['device_serial_number']."',user_id='".$user_id."' WHERE id=".$id."");
                }                
                else
                {                 
                    sqlinsert("INSERT INTO body_trace_number (pid,device_number,device_model,user_id) VALUES(?,?,?,?)",array($pid,$value['device_serial_number'],$value['device_model'],$user_id));
                }
           } 
        }
    //}
    // if(!empty($mail_device_number)){
    //     bodytrace_mail($mail_device_number);
    // }
    
    if($error_count!=0)
    {
        $result['status']='error';
        $result['error_msg']=$device_serailnumber;
    }
    else{
        $result['status']='success'; 
        $result['success_msg']=$success_count;       
    }
    echo json_encode($result);
    exit();
}
if(isset($_GET['save_assign_devices'])){
    $pid= $_POST['pid'];
    $result=[];
    $status='';
    $error_count=0;
    $serail_number=$_POST['serial_number'];
    $device_serailnumber=[];
    $success_count=0;
    // if(!empty($serail_number)){
        foreach($serail_number as $key=>$value)
        {
            if($value['device_serial_number']!=''){
                $success_count++;
            $already_exit_device=sqlQuery("SELECT * FROM smart_device_numbers WHERE pid NOT IN ($pid) AND serial_number='".$value['device_serial_number']."'");
            }
            if(isset($already_exit_device['serial_number'])&&$already_exit_device['serial_number']==$value['device_serial_number'])
           {
            $status='error';
            $error_count++;
            $exit_serial_number=$already_exit_device['serial_number'].' device Already Assign to Another Patient!!!';
            $device_serailnumber[]=$exit_serial_number;
           }
        
           else{
                //$device_result=sqlQuery("SELECT * FROM smart_device_numbers WHERE serial_number='".$value['device_serial_number']."'");
                
                $type=sqlQuery("SELECT * FROM smart_device_numbers WHERE device_model='".$value['device_model']."' AND pid=".$pid."");
                $id=isset($type['id'])?$type['id']:0;
                if($id)
                {
                    Sqlstatement("UPDATE smart_device_numbers SET serial_number='".$value['device_serial_number']."' WHERE id=".$id."");
                }                
                else
                {                 
                    sqlinsert("INSERT INTO smart_device_numbers (pid,serial_number,device_model) VALUES(?,?,?)",array($pid,$value['device_serial_number'],$value['device_model']));
                }
           } 
        }
    //}
    if($error_count!=0)
    {
        $result['status']='error';
        $result['error_msg']=$device_serailnumber;
    }
    else{
        $result['status']='success'; 
        $result['success_msg']=$success_count;       
    }
    echo json_encode($result);
    exit();
}
if(isset($_GET['assign_email']))
{
    $email=$_POST['email'];
    $pid=$_POST['pid'];
    $result=[];
    $email_exit=sqlQuery("SELECT * FROM patient_data WHERE pid NOT IN ($pid) AND googlefit_email='".$email."'");
    if(!empty($email_exit))
    {
        $msg=$email.' email id already assign to another patient';
        $result['status']='error';
        $result['msg']=$msg;
        echo json_encode($result);
        exit();
        
    }
    else{

        sqlStatement("UPDATE patient_data SET googlefit_email='".$email."' WHERE pid='".$pid."'");
        //echo "UPDATE patient_data SET googlefit_email='".$email."' WHERE pid='".$pid."'";
        $result['status']='success';
        $result['msg']='Googlefit Email id Assigned';
        echo json_encode($result);
        exit();
    }

}
if(isset($_GET['assign_tidepull_email']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $pid=$_POST['pid'];
    $result=[];
    $email_exit=sqlQuery("SELECT * FROM patient_data WHERE pid NOT IN ($pid) AND tidepull_email='".$email."'");
    if(!empty($email_exit))
    {
        $msg=$email.' email id already assign to another patient';
        $result['status']='error';
        $result['msg']=$msg;
        echo json_encode($result);
        exit();
        
    }
    else{
        sqlStatement("UPDATE patient_data SET tidepull_email='".$email."',tidepull_password='".$password."'  WHERE pid='".$pid."'");
        //echo "UPDATE patient_data SET googlefit_email='".$email."' WHERE pid='".$pid."'";
        $result['status']='success';
        $result['msg']='Tidepull Email id Assigned';
        echo json_encode($result);
        exit();
    }

}
if(isset($_GET['assign_Ambrosia_email']))
{

   $email=$_POST['email'];
    $password=$_POST['password'];
    $user=$_POST['user'];
    $pid=$_POST['pid'];  
    sqlStatement("UPDATE patient_data SET ambrosiasys_email=?,ambrosiasys_password=? WHERE pid=?",array($email,$password,$pid));
        //echo "UPDATE patient_data SET googlefit_email='".$email."' WHERE pid='".$pid."'";
        $result['status']='success';
        $result['msg']='Googlefit Email id Assigned';
        echo json_encode($result);
        exit(); 
   

}
if(isset($_GET['disconnect'])){
    $action = $_GET['disconnect'];
    if($action=='fit')
    {
        sqlStatement("UPDATE terra_googlefit SET status=0 WHERE pid='".$pid."'");
        echo '1';
        exit();
    }
    else if($action=='LIBRE'){
        sqlStatement("UPDATE terra_user SET status=0 WHERE pid='".$pid."'");
        echo '1';
        exit();
    }
    else if($action=='dexcom'){
        sqlStatement("UPDATE dexcom_token SET status=0 WHERE pid='".$pid."'");
        echo '1';
        exit();
    }
    else if($action=='marsonik'){
        sqlStatement("UPDATE patient_data SET marsonik_status=0 WHERE pid=?",array($pid));
        echo '1';
        exit();
    }
    else if($action=='omron'){
        sqlStatement("UPDATE omron_token SET status=0 WHERE pid=?",array($pid));
        echo '1';
        exit();
    }
}
if(isset($_GET['disconnect_email'])){
    $type=$_POST['type'];
    if($type=='googlefit'){
        sqlStatement("UPDATE patient_data SET googlefit_email=NULL WHERE pid='".$pid."'");
        echo '1';
        exit();
    }
    else if($type=='tidepull'){
        sqlStatement("UPDATE patient_data SET tidepull_email=NULL,tidepull_password=NULL WHERE pid='".$pid."'");
        echo '1';
        exit();
    }
    else if($type=='ambrosia'){
        sqlStatement("UPDATE patient_data SET ambrosiasys_email=NULL,ambrosiasys_password=NULL WHERE pid='".$pid."'");
        echo '1';
        exit();
    }
    
}
$records1 = array();
$records2 = array();
?>
<html>
    <head>
        <?php Header::setupHeader();?>
        <title><?php echo xlt('Assign Device'); ?></title>
        <script><?php require_once("$include_root/patient_file/erx_patient_portal_js.php"); // jQuery for popups for eRx and patient portal ?></script>
        <?php
        $arrOeUiSettings = array(
            'heading_title' => xl('Assign Device'),
            'include_patient_name' => true,
            'expandable' => false,
            'expandable_files' => array("external_data_patient_xpd", "stats_full_patient_xpd", "patient_ledger_patient_xpd"),//all file names need suffix _xpd
            'action' => "",//conceal, reveal, search, reset, link or back
            'action_title' => "",
            'action_href' => "",//only for actions - reset, link or back
            'show_help_icon' => false,
            'help_file_name' => "external_data_dashboard_help.php"
        );
        $oemr_ui    = new OemrUI($arrOeUiSettings);
        $pid        = isset($_SESSION['pid'])?$_SESSION['pid']:'';
        $organization_name=isset($_SESSION['organisation_name'])?trim($_SESSION['organisation_name']):'default';
        $sql_data   = sqlQuery("SELECT * FROM terra_user WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
        $sql_datag   = sqlQuery("SELECT * FROM terra_googlefit WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1");
        $dexcom_sql   = sqlQuery("SELECT * FROM dexcom_token WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1"); 
        $omron_sql= sqlQuery("SELECT * FROM omron_token WHERE pid='".$pid."' ORDER BY `id` DESC LIMIT 1"); 
        ?>
        <style>
            .checkmark {
      display: inline-block;
      transform: rotate(45deg);
      height: 25px;
      width: 12px;
      margin-left: 60%; 
      border-bottom: 7px solid #78b13f;
      border-right: 7px solid #78b13f;
    }
    .your-class::-webkit-input-placeholder {
        color: red;
    }
    #googlfit_err_msg{
        color: red;
    }
    #ambrosia_err_msg{
        color: red;
        margin-left:10px;
    }
    #ambrosia_err_pass{
        color: red;
        margin-left:10px;
    }
    #ambrosia_err_user{
        color: red;
        margin-left:10px;
    }
    #tidepull_email_msg{
        color:red;
    }
    #cnfrm{
          /* display: none; */
          position: fixed;
          top: 35%;
          left: 39%;
          width: 400px;
          text-align:center;
          font-weight:bold;
          font-size:20px;
          padding: 10px 30px 15px;
          border:none;
          box-shadow: 4px 3px 7px #bfbfbf;
          background: #ffffffd6;
           color: #000;
           z-index: 1002;
          overflow: auto;
     }
            </style>
            <script>
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
                function googfitassign(){
                    $("#googfitassign").modal('show');
                } 
                function googlefit_connected(){
                    var email=$("#googlefit_mail").val();                    
                    if(email==''){                        
                        $("#error_content").text('Enter Email for Authentication');
                        signerAlertMsg('Enter Email for Authentication', 2000, 'danger'); 
                        // $("#bsModal3").modal('show');
                        // setTimeout(function() { $("#bsModal3").modal('hide');}, 1000);
                        return false;
                    }
                    else{
                           
                        
                        $.ajax({
                        "async": true,
                        "crossDomain": true,
                        "url": "./authentication1.php?google_fit=true",
                        "method": "GET",
                        beforeSend: function() {
                            // setting a timeout
                           
                            $("#assign_gmail").prop("disabled", true);
                            $("#circle_g").removeClass('far fa-check-circle');
                            $("#circle_g").addClass('fa fa-spinner fa-spin');
                        },
                        success: function(response) 
                        {
                            
                            var data = $.parseJSON(response);
                            var auth_url=data.auth_url;  
                            var status=data['status'];                        
                            $("#assign_gmail").prop("disabled", false);
                            $("#circle_g").removeClass('fa fa-spinner fa-spin');
                            $("#circle_g").addClass('far fa-check-circle');                            
                            signerAlertMsg(data['message'], 2000, data['status']);
                            $("#googfitassign").modal('hide');
                            if(status=='success')
                            {                                                       
                                $("#device_type").val('googlefit');
                                $("#verify_done").hide();                            
                                $("#verify_done a").trigger('click');
                            }

                        }
                    }); 
                    }
                   
                }
                function dexcom_connect(){
                    
                    $.ajax({
                        "async": true,
                        "crossDomain": true,
                        "url": "./authentication1.php?dexcom=true",
                        "method": "GET",
                        beforeSend: function() {                           
                            $("#dexcom_connect_btn").prop("disabled", true);                            
                        },
                        success: function(response) 
                        {                       
                            $("#dexcom_connect_btn").removeAttr("disabled");                                               
                            signerAlertMsg('The authentication URL was sent to the patients email Successfully!', 2000, 'success'); 
                            $("#device_type").val('dexcom');
                            $("#verify_done").hide();                            
                            $("#verify_done a").trigger('click');                           

                        }
                    });
                    // var dexcom_url='../../dexcom_redirect.php?site='+org+'&pid='+pid+'';      
                    // window.open(dexcom_url,'_blank'); 
                      
                }  
                function omron_connect(){
                    
                    var email='<?php echo $patient_email;?>';                    
                    if(!email){                       
                        signerAlertMsg('Patient dont have email id', 2000, 'danger');
                        return false;
                    }
                    else{
                        $.ajax({
                            "async": true,
                            "crossDomain": true,
                            "url": "./authentication1.php?omron=true",
                            "method": "GET",
                            beforeSend: function() {                            
                            $("#omron_connect_btn").prop("disabled", true);                            
                            },
                            success: function(response) 
                            {
                                
                                var data= JSON.parse(response);
                                var status=data['status'];
                                $("#omron_connect_btn").removeAttr("disabled");
                                signerAlertMsg(data['message'], 2000, data['status']); 
                                if(status=='success')
                                {
                                    $("#device_type").val('omron');                                
                                    $("#verify_done").hide();                            
                                    $("#verify_done a").trigger('click');
                                    
                                }

                            }
                        });  
                        
                                     
                    }
               
                }
                /***fitbit  */
                function fitbit_connect(){
                    
                    var email='<?php echo $patient_email;?>';                    
                    if(!email){                       
                        signerAlertMsg('The patient does not have an email Id To Add Please Navigate to Dashboard->Demographic->Contact', 2000, 'danger');
                        return false;
                    }
                    else{
                        $.ajax({
                            "async": true,
                            "crossDomain": true,
                            "url": "./authentication1.php?fitbit=true",
                            "method": "GET",
                            beforeSend: function() {                            
                            $("#fitbit_connect_btn").prop("disabled", true);                            
                            },
                            success: function(response) 
                            {
                                var data= JSON.parse(response);
                                 var status=data['status'];
                                //var data =response.
                                $("#fitbit_connect_btn").removeAttr("disabled");                               
                                signerAlertMsg(data['message'], 2000, data['status']); 
                                if(status=='success')
                                {
                                    $("#device_type").val('fitbit');
                                    $("#verify_done").hide();                            
                                    $("#verify_done a").trigger('click');
                                }
                            }
                        });  
                        
                                     
                    }
               
                } 
                function dexcom_disconnect_model(){
                    $("#gconnectedmodel").modal('show');
                    $("#gconnectedmodel #error_content").html('<center>Do You Want to disconnect *DEXCOM*</center>');
                    $("#gconnectedmodel .addaction").html('<button type="button" class="btn btn-primary btn-sm" onclick="disconnect('+"'"+'dexcom'+"'"+');">Yes</button>');   
                }
                function marsonik_disconnect_model(){
                    $("#gconnectedmodel").modal('show');
                    $("#gconnectedmodel #error_content").html('<center>Do You Want to disconnect *MARSONIK*</center>');
                    $("#gconnectedmodel .addaction").html('<button type="button" class="btn btn-primary btn-sm" onclick="disconnect('+"'"+'marsonik'+"'"+');">Yes</button>');   
                }
                function omron_disconnect_model(){
                    $("#gconnectedmodel").modal('show');
                    $("#gconnectedmodel #error_content").html('<center>Do You Want to disconnect *OMRON*</center>');
                    $("#gconnectedmodel .addaction").html('<button type="button" class="btn btn-primary btn-sm" onclick="disconnect('+"'"+'omron'+"'"+');">Yes</button>');   
                }
                function fitbit_disconnect_model(){
                    $("#gconnectedmodel").modal('show');
                    $("#gconnectedmodel #error_content").html('<center>Do You Want to disconnect *FITBIT*</center>');
                    $("#gconnectedmodel .addaction").html('<button type="button" class="btn btn-primary btn-sm" onclick="disconnect('+"'"+'fitbit'+"'"+');">Yes</button>');   
                }
                function marsonik_connect()
                {
                
                    var org='<?php echo $organization_name;?>';
                    var pid='<?php echo $pid;?>';
                    window.open("./marsonick.php?pid="+pid+"", '_blank');
                    // let title = '<?php echo xlt('Marsonik'); ?>';
                    //  dlgopen('./marsonick.php', 'marsoncikpush', 650, 900, '', title);
                    $("#device_type").val('marsonik');
                    $("#verify_done").hide();                            
                    $("#verify_done a").trigger('click'); 
                }

                function libree_connect(){
                    $.ajax({
                        "async": true,
                        "crossDomain": true,
                        "url": "./authentication1.php?libre=true",
                        "method": "GET",
                        beforeSend: function() {   
                            $("#libree_btn_con").prop("disabled", true);                                
                        },
                        success: function(response) 
                        {
                            var data= JSON.parse(response);
                            var status=data['status'];
                            
                            $("#libree_btn_con").removeAttr("disabled");
                            signerAlertMsg(data['message'], 2000, data['status']); 
                            if(status=='success')
                            {
                                $("#device_type").val('libre');                                
                                $("#verify_done").hide();                            
                                $("#verify_done a").trigger('click');
                                
                            }
                                

                        }
                    }); 
                }               
                </script>
    </head>
    <body>
        <div id="container_div" class="<?php echo $oemr_ui->oeContainer();?> mt-3">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    require_once("$include_root/patient_file/summary/dashboard_header.php")
                    ?>
                </div>
            </div>
            <?php
            $list_id = "assign_device"; // to indicate nav item is active, count and give correct id
            // Collect the patient menu then build it
            $menuPatient = new PatientMenuRole();
            $menuPatient->displayHorizNavBarMenu();
            ?>
            <div class="row mt-3">

                <div class="col-sm-12" style="margin-top: 20px;">
            
                    <div id="HIS">
                        <ul class="tabNav">        
                            <li ><a href="#" class="device_list" id="terra_list">Terra App</a></li>
                            <li ><a href="#" class="device_list" id="smart_meter_list">Smart Meter Device</a> </li>
                            <li ><a href="#" class="device_list" id="Ambrosia">Ambrosia App</a> </li>
                            <li ><a href="#" class="device_list" id="tidepull">Tidepool</a> </li>
                            <li ><a href="#" class="device_list" id="marsonick">Marsonik</a> </li>
                            <li ><a href="#" class="device_list" id="dexcom">Dexcom</a> </li>
                            <li ><a href="#" class="device_list" id="body_trace">BodyTrace</a> </li>
                            <li ><a href="#" class="device_list" id="tenovi">Tenovi</a> </li>
                           
                        </ul>
                        <div class="tabContainer">
                            <div class="tab current" id="tab_terra_list">
                                <div class="mt-3" style="display:flex;">
                                <div id="googlelibresuccess">
                                    <?php if(isset($sql_data['status']) && $sql_data['status']==1){  ?>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="model_view1();" value="<?php echo xla('FREESTYLELIBRE'); ?>" ><?php echo xlt('FREESTYLELIBRE'); ?> <span class="badge badge-success" style="display:inline"><i class="fa fa-check" style="font-size:15px;color:white"></i></span></button>
                                    <?php }elseif(isset($sql_data['status']) && $sql_data['status']==0){?>
                                        <button type="button" class="myapp btn btn-primary btn-sm" onclick="libree_connect()" id="libree_btn_con" value="<?php echo xla('FREESTYLELIBRE'); ?>" ><?php echo xlt('FREESTYLELIBRE'); ?><span class="badge badge-danger" style="display:inline"> <i class="fa fa-close" style="font-size:15px;color:white"></i></span></button>
                                        
                                        <?php }else{ ?>
                                        <button type="button" class="myapp btn btn-primary btn-sm" onclick="libree_connect()" id="libree_btn_con" value="<?php echo xla('FREESTYLELIBRE'); ?>" ><?php echo xlt('FREESTYLELIBRE'); ?></button>
                                        
                                    <?php } ?> 
                                    </div> 
                                    <div id="googlefitsuccess">
                                    <?php if(isset($sql_datag['status']) && $sql_datag['status']==1){  ?>
                                    <button type="button" class="btn btn-primary btn-sm ml-2" value="<?php echo xla('GOOGLEFIT'); ?>" ><?php echo xlt('GOOGLEFIT'); ?> <span class="badge badge-success span1" id='span1' style="display:inline"><i class="fa fa-check gconnected" id='gconnected' style="font-size:15px;color:white"></i></span></button>
                                    <?php }elseif(isset($sql_datag['status']) && $sql_datag['status']==0){?>
                                        <button type="button" class="googlefit btn btn-primary btn-sm ml-2 gfitclass" value="<?php echo xla('GOOGLEFIT'); ?>" ><?php echo xlt('GOOGLEFIT'); ?><span class="badge badge-danger span1" id='span1' style="display:inline"> <i class="fa fa-close gconnected" style="font-size:15px;color:white"></i></span></button>
                                        
                                        <?php }else{ ?>
                                            <button type="button" class="googlefit btn btn-primary btn-sm ml-2 gfitclass" value="<?php echo xla('GOOGLEFIT'); ?>" ><?php echo xlt('GOOGLEFIT'); ?></button>
                                        
                                    <?php } ?> 
                                    <!-- <button type="button" class="dexcom btn btn-primary btn-sm ml-2 " value="<?php echo xla('DEXCOM'); ?>" ><?php echo xlt('DEXCOM'); ?></button> -->
                                    </div>

                                    <div class="omron" id='omron_span'>
                                      <?php
                                       if(isset($omron_sql['status']) && $omron_sql['status']==1){
                                        $span_class="<span class='badge badge-success ml-1' style='display:inline' onclick='omron_disconnect_model()'> <i class='fa fa-check' style='font-size:15px;color:white'></i></span>";
                                        echo "<button type='button' class='btn btn-primary btn-sm ml-2' style='display:flex' >OMRON".$span_class."</button>";                                           
                                        }
                                        elseif(isset($omron_sql['status']) && $omron_sql['status']==0){
                                            $span_class="<span class='badge badge-danger ml-1' style='display:inline'> <i class='fa fa-close' style='font-size:15px;color:white'></i></span>";
                                            echo "<button type='button' onclick='omron_connect()'  class='btn btn-primary btn-sm ml-2' id='omron_connect_btn' style='display:flex' >OMRON".$span_class."</button>";                                           
                                        } 
                                        else{                                            
                                            echo "<button type='button' onclick='omron_connect()' class='btn btn-primary btn-sm ml-2'id='omron_connect_btn' style='display:flex' >OMRON</button>";                                         
                                        }
                                     
                                      ?>  
                                    
                                    </div> 
                                       
                                </div>
                                <div class="mt-3">
                                <p id="verify_done" style="display:none;">Once Authentication done<a href="#"> Click here</a></p>
                                <p id="success_msg" style="display:none;">Authetication Code Send to Patient mail</p>
                                <input type="hidden" id="device_type">
                                <p id="msg"></p>
                                </div>
                                
                            </div>   
                            <div class='tab' id="tab_smart_meter_list" style="background: white;border: none;">

                                <div class="row">
                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $iglucose_data=sqlQuery("SELECT * FROM smart_device_numbers WHERE pid=? AND device_model='Iglucose meter'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">iGlucose Glucometer</p>
                                            <input type="checkbox" id="iglucose_meter1" class="assign-device-checkbox" value="<?php echo $iglucose_data['serial_number']?>" data-id="iglucose_meter" <?php echo $iglucose_data['serial_number']?'checked':''; ?>>
                                            <img src="../image/iglucose.png" style="width: 90px;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" id="iglucose_meter" maxlength="7" class="form-control assign-device-serial-number" value="<?php echo $iglucose_data['serial_number']?$iglucose_data['serial_number']:'';?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $pulse_device=sqlQuery("SELECT * FROM smart_device_numbers WHERE pid=? AND device_model='Pulse Oximeter'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">pulse oximeter</p>                                        
                                            <input type="checkbox" id="pulse_oximeter1" class="assign-device-checkbox" value="<?php echo $pulse_device['serial_number']?>" data-id="pulse_oximeter" <?php echo $pulse_device['serial_number']?'checked':''; ?>> <img src="../image/smartpulse.png" style="width: 90px;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15" id="pulse_oximeter" class="form-control assign-device-serial-number" value="<?php echo $pulse_device['serial_number']?$pulse_device['serial_number']:''; ?>">
                                        </div>
                                    </div> 

                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $Weighting_device=sqlQuery("SELECT * FROM smart_device_numbers WHERE pid=? AND device_model='Weighting scale'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">weighting scale</p>                                            
                                            <input type="checkbox" id="weighting_scale1" class="assign-device-checkbox" value="<?php echo $Weighting_device['serial_number']?>" data-id="weighting_scale" <?php echo $Weighting_device['serial_number']?'checked':''; ?>> <img src="../image/weight_scale.png" style="width: 90px;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15"  id="weighting_scale" class="form-control assign-device-serial-number" value="<?php echo $Weighting_device['serial_number']?$Weighting_device['serial_number']:''; ?>">
                                        </div>
                                    </div>   
                                    
                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $bp_device=sqlQuery("SELECT * FROM smart_device_numbers WHERE pid=? AND device_model='Blood Pressure'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">iBlood Pressure</p>                                            
                                            <input type="checkbox" id="iblood_pressure1" class="assign-device-checkbox" value="<?php echo $bp_device['serial_number']?>" data-id="iblood_pressure" <?php echo $bp_device['serial_number']?'checked':''; ?>> <img src="../image/smart-meter-ibloodpressure.png" style="width: 90px;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15" id="iblood_pressure" class="form-control assign-device-serial-number" value="<?php echo $bp_device['serial_number']?$bp_device['serial_number']:''; ?>">
                                        </div>
                                    </div> 

                                    <div class="row col-12 pl-5" id="error_msg_show">                                 
                                        
                                    </div>

                                    <div class="row col-12 pl-5 ">
                                    
                                        <div class="form-group pl-4">
                                            <button type="button" class="btn btn-primary mr-3" onclick="assign_device('connect');" id="assign-patient-device-button">
                                                <i class="far fa-check-circle " ></i> Assign
                                            </button>
                                                
                                        </div>
                                    </div>

                                </div>    
                            </div>
                            <div class="tab" id="tab_Ambrosia">
                                <div class="mt-3" style="display:flex;">
                                    <div class="row">
                                        <!-- <div class="col-12">
                                            <label>Ambrosia User:</label>
                                            <div style="display:flex;">
                                                <input type="text" id="Ambrosia_user" value="<?php echo $patient_data['ambrosiasys_signature']?$patient_data['ambrosiasys_signature']:'';?>"   class="form-control" >
                                            </div>
                                        </div> -->
                                        <div class="col-12">
                                            <label>Ambrosia Email:</label>
                                            <div style="display:flex;">
                                                <input type="email" id="Ambrosia_email" style="width:50% !important;" required value="<?php echo $patient_data['ambrosiasys_email']?$patient_data['ambrosiasys_email']:'';?>"  class="form-control">

                                                <?php
                                                $ambrosia_email=isset($patient_data['ambrosiasys_email'])?$patient_data['ambrosiasys_email']:'';
                                                if($ambrosia_email!=''){
                                                    $ambrosia_display='block';
                                                }
                                                else{
                                                    $ambrosia_display='none';
                                                }
                                                ?>
                                                <i class="fa fa-close" id='clear_email_ambrosia' onclick="clear_email('ambrosia')" style="margin: 10px;margin-left:-18px;display:<?php echo $ambrosia_display;?>;font-size:15px;color:red"></i>
                                            </div>
                                        </div>
                                        <!-- <div class="row col-12" id="ambrosia_err_user"></div> -->
                                        
                                        <div class="col-12">
                                            <label>Ambrosia Password:</label>
                                            <div style="display:flex;">
                                                <input type="text" id="Ambrosia_password" style="width:50% !important;" value="<?php echo $patient_data['ambrosiasys_password']&&$ambrosia_email!=''?$patient_data['ambrosiasys_password']:'';?>" class="form-control">                                               
                                            </div>
                                        </div>
                                        <div class="row col-12" id="ambrosia_err_pass"></div>
                                        
                                        <div class="row col-12" id="ambrosia_err_msg"></div>                            
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary mr-3" onclick="assign_Ambrosia_email();" id="assign-patient-device-button">
                                                    <i class="far fa-check-circle " ></i> Assign
                                                </button>
                                                    
                                            </div>
                                        </div> 
                                     </div>
                                </div>
                            </div> 
                            <!-- //end amb -->
                            <!--tide pull--->
                            <div class="tab" id="tab_tidepull">
                                <div class="mt-3" style="display:flex;">
                                    <div class="row">
                                        
                                        <div class="col-12">
                                            <label>Tidepool Email:</label>
                                            <div style="display:flex;">
                                                <input type="text" id="tidepull_email" value="<?php echo $patient_data['tidepull_email']?$patient_data['tidepull_email']:'';?>" class="form-control" style="width:50% !important;">
                                                <?php
                                                $tidepull_gmail=$patient_data['tidepull_email']?$patient_data['tidepull_email']:'';
                                                if($tidepull_gmail!=''){
                                                    $tidepull_display='block';
                                                }
                                                else{
                                                    $tidepull_display='none';
                                                }
                                                ?>
                                                <i class="fa fa-close" id='clear_email_tidepull' onclick="clear_email('tidepull')" style="margin: 10px;margin-left:-18px;display:<?php echo $tidepull_display;?>;font-size:15px;color:red"></i>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>Tidepool Password:</label>
                                            <div style="display:flex;">
                                                <input type="text" id="tidepull_password"  value="<?php echo $patient_data['tidepull_password']&&$tidepull_gmail!=''?$patient_data['tidepull_password']:'';?>" class="form-control" style="width:50% !important;">
                                            </div>
                                        </div>                                        
                                        
                                        <div class="col-12" id="tidepull_email_msg"></div>
                                                                  
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary mr-3" onclick="assign_tidepull();" id="assin_tidepull">
                                                    <i class="far fa-check-circle " ></i> Assign
                                                </button>
                                                    
                                            </div>
                                        </div> 
                                     </div>
                                </div>
                            </div> 
                            <!---tide pull-->

                            <div class="tab" id="tab_dexcom">
                                <div class="mt-3" style="display:flex;">
                                
                                    <div class="dexcom" id='dexcom_span'>
                                          <?php
                                           if(isset($dexcom_sql['status']) && $dexcom_sql['status']==1){
                                            $span_class="<span class='badge badge-success ml-1' style='display:inline' onclick='dexcom_disconnect_model()'> <i class='fa fa-check' style='font-size:15px;color:white'></i></span>";
                                            echo "<button type='button' class='btn btn-primary btn-sm ml-2' style='display:flex' >DEXCOM".$span_class."</button>";                                           
                                        }
                                        elseif(isset($dexcom_sql['status']) && $dexcom_sql['status']==0){
                                            $span_class="<span class='badge badge-danger ml-1' style='display:inline'> <i class='fa fa-close' style='font-size:15px;color:white'></i></span>";
                                            echo "<button type='button' onclick='dexcom_connect()' id='dexcom_connect_btn' class='btn btn-primary btn-sm ml-2' style='display:flex' >DEXCOM".$span_class."</button>";                                           
                                        } 
                                          else{                                            
                                            echo "<button type='button' onclick='dexcom_connect()' id='dexcom_connect_btn' class='btn btn-primary btn-sm ml-2' style='display:flex' >DEXCOM</button>";                                         
                                          }
                                         
                                          ?>  
                                        
                                    </div> 
                                       
                                </div>
                                
                              
                            </div>
                                          <!--marsnic-->
                            <div class="tab" id="tab_marsonick">
                                <div class="mt-3" style="display:flex;">
                                    <div class="row">
                                    <div id='marsonik_span'>
                                          <?php
                                           if(isset($patient_data['marsonik_status']) && $patient_data['marsonik_status']==1){
                                            $span_class="<span class='badge badge-success ml-1' style='display:inline' onclick='marsonik_disconnect_model()'> <i class='fa fa-check' style='font-size:15px;color:white'></i></span>";
                                            echo "<button type='button' class='btn btn-primary btn-sm ml-2' style='display:flex' >MARSONIK".$span_class."</button>";                                           
                                        }
                                        elseif(isset($patient_data['marsonik_status']) && $patient_data['marsonik_status']!=1){
                                            $span_class="<span class='badge badge-danger ml-1' style='display:inline'> <i class='fa fa-close' style='font-size:15px;color:white'></i></span>";
                                            echo "<button type='button' onclick='marsonik_connect()' class='btn btn-primary btn-sm ml-2' style='display:flex' >MARSONIK".$span_class."</button>";                                           
                                        } 
                                          else{                                            
                                            echo "<button type='button' onclick='marsonik_connect()' class='btn btn-primary btn-sm ml-2' style='display:flex' >MARSONIK</button>";                                         
                                          }
                                         
                                          ?>  
                                        
                                    </div> 
                                       <!-- <button onclick="update_patient_api()" class="ml-2 btn btn-primary" type="button">Marsonik Connect</button>  -->
                                    </div>
                                </div>
                            </div>
                            <!--marsnic-->
                            <!-- body trace -->        
                            <div class='tab' id="tab_body_trace" style="background: white;border: none;">

                                <div class="row">

                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $Weighting_body_trace=sqlQuery("SELECT * FROM body_trace_number WHERE pid=? AND device_model='Body Trace Weight'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">Body Trace weight</p>                                            
                                            <input type="checkbox" id="body_trace_weight1" class="body-trace-checkbox" value="<?php echo $Weighting_body_trace['device_number']?>" data-id="body_trace_weight" <?php echo $Weighting_body_trace['device_number']?'checked':''; ?>> <img src="../image/weight_body_trace.jpg" style="width: 90px;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15"  id="body_trace_weight" class="form-control body-trace-serial-number" value="<?php echo $Weighting_body_trace['device_number']?$Weighting_body_trace['device_number']:''; ?>">
                                        </div>
                                    </div>   

                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $pulse_device=sqlQuery("SELECT * FROM body_trace_number WHERE pid=? AND device_model='Pulse Meter'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">Blood Pressure</p>                                            
                                            <input type="checkbox" id="pulse_meter1" class="body-trace-checkbox" value="<?php echo $pulse_device['device_number']?>" data-id="pulse_meter" <?php echo $pulse_device['device_number']?'checked':''; ?>> <img src="../image/bodytrace_blood_pressure.jpg" style="width: 90px;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15" id="pulse_meter" class="form-control body-trace-serial-number" value="<?php echo $pulse_device['device_number']?$pulse_device['device_number']:''; ?>">
                                        </div>
                                    </div> 

                                    <div class="row col-12 pl-5" id="error_msg_show1">                                 
                                                                        
                                    </div>

                                    <div class="row col-12 pl-5 ">

                                        <div class="form-group pl-4">
                                            <input type="hidden" id="disconnect_device_value">
                                            <button type="button" class="btn btn-primary mr-3" id="bodytrace_btn" onclick="body_trace('connect');" id="body-trace-device-button">
                                                <i class="far fa-check-circle " ></i> Assign
                                            </button>
                                                
                                        </div>
                                    </div>

                                </div>    
                            </div> 
                            
                             <!----tenovi------>
                             <div class='tab' id="tab_tenovi" style="background: white;border: none;">

                                <div class="row">

                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $tenovi_device_bpm=sqlQuery("SELECT * FROM tenovi_data WHERE pid=? AND device_name='Tenovi BPM'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">Tenovi BPM</p>                                            
                                            <input type="checkbox" id="tenovi_bpm1" class="tenovi-device-checkbox" value="<?php echo $tenovi_device_bpm['device_id']?>" data-id="tenovi_bpm" <?php echo $tenovi_device_bpm['device_id']?'checked':''; ?>>
                                            <img src="../image/Tenovi-BPM.png" style="width: 40%;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15"  id="tenovi_bpm" class="form-control tenovi-serial-number" value="<?php echo $tenovi_device_bpm['device_id']?$tenovi_device_bpm['device_id']:''; ?>">
                                        </div>
                                    </div>   

                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $tenovi_ox_device=sqlQuery("SELECT * FROM tenovi_data WHERE pid=? AND device_name='Tenovi Pulse Ox'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">Tenovi POx</p>                                            
                                            <input type="checkbox" id="tenovi_ox1" class="tenovi-device-checkbox" value="<?php echo $tenovi_ox_device['device_id']?>" data-id="tenovi_ox" <?php echo $tenovi_ox_device['device_id']?'checked':''; ?>>
                                            <img src="../image/tenovi_ox.jpg" style="width: 40%;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15" id="tenovi_ox" class="form-control tenovi-serial-number" value="<?php echo $tenovi_ox_device['device_id']?$tenovi_ox_device['device_id']:''; ?>">
                                        </div>
                                    </div> 
                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $tenovi_glucometer_device=sqlQuery("SELECT * FROM tenovi_data WHERE pid=? AND device_name='Tenovi Glucometer'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">Tenovi BGM</p>                                            
                                            <input type="checkbox" id="tenovi_glucometer1" class="tenovi-device-checkbox" value="<?php echo $tenovi_glucometer_device['device_id']?>" data-id="tenovi_glucometer" <?php echo $tenovi_glucometer_device['device_id']?'checked':''; ?>>
                                            <img src="../image/tenovi_bg.jpg" style="width: 80px;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15" id="tenovi_glucometer" class="form-control tenovi-serial-number" value="<?php echo $tenovi_glucometer_device['device_id']?$tenovi_glucometer_device['device_id']:''; ?>">
                                        </div>
                                    </div> 
                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $tenovi_scale_deice=sqlQuery("SELECT * FROM tenovi_data WHERE pid=? AND device_name='Tenovi Scale'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">Tenovi Scale</p>                                            
                                            <input type="checkbox" id="tenovi_scale1" class="tenovi-device-checkbox" value="<?php echo $tenovi_scale_deice['device_id']?>" data-id="tenovi_scale" <?php echo $tenovi_scale_deice['device_id']?'checked':''; ?>> 
                                            <img src="../image/tenovi_scale.jpg" style="width: 40%;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15" id="tenovi_scale" class="form-control tenovi-serial-number" value="<?php echo $tenovi_scale_deice['device_id']?$tenovi_scale_deice['device_id']:''; ?>">
                                        </div>
                                    </div> 
                                    <div class="col-md-6 col-12  assign-device-block mb-4" id="bodyTraceWeighingScale" style="background-color: rgb(255, 255, 255);">
                                        <?php
                                        $tenovi_flow_device=sqlQuery("SELECT * FROM tenovi_data WHERE pid=? AND device_name='Tenovi Peak Flow Meter'",array($pid));
                                        ?>
                                        <div class="text-center" style="height: 140px;">
                                            <p class="mb-0">Tenovi PFM</p>                                            
                                            <input type="checkbox" id="tenovi_flow1" class="tenovi-device-checkbox" value="<?php echo $tenovi_flow_device['device_id']?>" data-id="tenovi_flow" <?php echo $tenovi_flow_device['device_id']?'checked':''; ?>> 
                                            <img src="../image/tenovi_peak.jpg" style="width: 40%;">

                                        </div>
                                        <div class="form-group w-75 m-auto">
                                            <label>Serial No</label> <span class="color-red" style="color:red;">* </span>
                                            <button type="submit" class=" pr-3" style="border: 0; background: none;" data-tooltip="15 Digit Serial number can be found in back of the device">
                                                <i class="far fa-xs fa-question-circle font-gray"></i>
                                            </button>
                                            <input type="text" maxlength="15" id="tenovi_flow" class="form-control tenovi-serial-number" value="<?php echo $tenovi_flow_device['device_id']?$tenovi_flow_device['device_id']:''; ?>">
                                        </div>
                                    </div> 
                                    <div class="row col-12 pl-5" id="error_msg_show2">                                 
                                                                        
                                    </div>

                                    <div class="row col-12 pl-5 ">

                                        <div class="form-group pl-4">
                                            <input type="hidden" id="disconnect_tenovi_value">
                                            <button type="button" class="btn btn-primary mr-3" onclick="tenovi_device_connect('connect');" id="tenovi-device-button">
                                                <i class="far fa-check-circle " id='tenovi_loader'></i> Assign
                                            </button>
                                                
                                        </div>
                                    </div>

                                </div>    
                            </div>

                        </div>                
                    </div>
                </div>                
                
            </div>
        </div><!--end of container div-->
        <!-- <i class="fa fa-spinner fa-spin" id="show_verify"></i> -->

        <div id="cnfrm" class="alert alert-primary" style="display:none">
<strong>Need to Remove the Device</strong><br>
<div align="center">
<button type="button" id="yesbtn" class="btn btn-success" onclick="disconnect_devices()"style="padding:5px 22px"> Yes</button>
<button type="button" id="nobtn" class="btn btn-danger" onclick="$('#cnfrm').css('display','none')" style="padding:5px 22px">No</button></div>
</div>
        <?php $oemr_ui->oeBelowContainerDiv();?>
        <script>
            var listId = '#' + <?php echo js_escape($list_id); ?>;
            $(function () {
                $(listId).addClass("active");
            });

            $(function() {
                $('.nav-link').click(function() {
                    $('.nav-link').removeClass("active");
                    $(this).addClass("active");
                });

            });
            var device_ids;
            $(".assign-device-checkbox").change(function(){
                var id = $(this).attr('data-id');
                var value=$(this).val();
                device_ids = id;
                if($(this).is(":checked")){
                    //alert(id);
                 $('#'+id).removeAttr("disabled");
                 $('#'+id).css('border-color','#979b9f');
                    $('#'+id).attr('placeholder','');
                }
                else{
                    if(value!=''){
                        $("#cnfrm").css("display","block");
                        // $(this).val('');
                       
                    }
                    else{
                        $('#'+id).css('border-color','#979b9f');
                    $('#'+id).attr('placeholder','');
                    $('#'+id).val('');
                    $('#'+id).prop('disabled', true);
                    }
                    
                    
                }
            })
            
            $(function () {
                $(".assign-device-checkbox").each(function(){                
                    var id = $(this).attr('data-id');                
                    if($(this).is(":checked")){
                        //alert(id);
                    $('#'+id).removeAttr("disabled");
                    
                    }
                    else{
                        $('#'+id).val('');
                    $('#'+id).attr("disabled","true");
                    }
                });
                $(".body-trace-checkbox").each(function(){                
                    var id1 = $(this).attr('data-id');                
                    if($(this).is(":checked"))
                    {
                        $('#'+id1).removeAttr("disabled");                
                    }
                    else{
                        $('#'+id1).val('');
                        $('#'+id1).attr("disabled","true");
                    }
                });
                $("#verify_done").hide();
                $("#success_msg").hide();
                //googlefit
                $(".googlefit").click(function() {
                    //googlefit_connected();
                    $("#googfitassign").modal('show');
                    $("#googlfit_err_msg").html('');

                }); 
                   
                
                //end googlefit
                $(document).on("click","#verify_done a",function() {                       
                    var device_type=$('#device_type').val();                    
                    $.ajax({
                        "async": true,
                        "crossDomain": true,
                        "url": "./token.php?device_type="+device_type+"",
                        "method": "GET",
                        success: function(response) 
                        {
        
                            if(response==1)
                            {
                                if(device_type == "googlefit")
                                {
                                user_auth="*GOOGLEFIT* Successfully Connected";
                                $("#msg").html(user_auth);
                                $("#msg").css("color", "green"); 
                                signerAlertMsg('*GOOGLEFIT* Successfully Connected', 7000, 'success');                               
                               // alert("*GOOGLEFIT* Successfully Connected");
                                $('#success_msg').html('');  
                                    $("#googlefitsuccess").html('<button type="button" onclick="model_view();" class="btn btn-primary btn-sm ml-2" value="GOOGLEFIT" >GOOGLEFIT<span class="badge badge-success span1" style="display:inline"><i class="fa fa-check gconnected" id="gconnected" style="font-size:15px;color:white"></i></span></button>');
                                //$("#googlefitsuccess1").html('<button type="button" onclick="model_view();" class="btn btn-primary btn-sm ml-2" value="GOOGLEFIT" >GOOGLEFIT<span class="badge badge-success span1" id="span1" style="display:inline"><i class="fa fa-check gconnected" id="gconnected" style="font-size:15px;color:white"></i></span></button>');
                                } 
                                if(device_type == "libre")
                                {
                              
                                user_auth="*FREE STYLE LIBRE* Successfully Connected";
                                $("#msg").html(user_auth);
                                $("#msg").css("color", "green");
                                signerAlertMsg('*FREE STYLE LIBRE* Successfully Connected', 7000, 'success');
                                $('#success_msg').html(''); 
                                    $("#googlelibresuccess").html('<button type="button" class="btn btn-primary btn-sm" onclick="model_view1();" value="FREESTYLELIBRE" >FREESTYLELIBRE <span class="badge badge-success" style="display:inline"><i class="fa fa-check" style="font-size:15px;color:white"></i></span></button>');   
                                } 
                                if(device_type == "dexcom")
                                {
                              
                                user_auth="*DEXCOM* Successfully Connected";
                                $("#msg").html(user_auth);
                                $("#msg").css("color", "green");                                
                                signerAlertMsg('*DEXCOM* Successfully Connected', 7000, 'success');
                                $('#success_msg').html('');
                                $("#dexcom_span").html("<button type='button' class='btn btn-primary btn-sm ml-2' style='display:flex' >DEXCOM<span class='badge badge-success ml-1' style='display:inline' onclick='dexcom_disconnect_model();'> <i class='fa fa-check' style='font-size:15px;color:white'></i></span></button>"); 
                               
                                } 
                                if(device_type == "omron")
                                {
                              
                                user_auth="*OMRON* Successfully Connected";
                                $("#msg").html(user_auth);
                                $("#msg").css("color", "green");                                
                                signerAlertMsg('*OMRON* Successfully Connected', 7000, 'success');
                                $('#success_msg').html('');
                                $("#omron_span").html("<button type='button' class='btn btn-primary btn-sm ml-2' style='display:flex' >OMRON<span class='badge badge-success ml-1' style='display:inline' onclick='omron_disconnect_model();'> <i class='fa fa-check' style='font-size:15px;color:white'></i></span></button>"); 
                               
                                } 
                                if(device_type == "marsonik")
                                {
                              
                                user_auth="*MARSONIK* Successfully Connected";
                                $("#msg").html(user_auth);
                                $("#msg").css("color", "green");                                
                                signerAlertMsg('*MARSONIK* Successfully Connected', 6000, 'success');  
                                $('#success_msg').html('');
                                $("#marsonik_span").html("<button type='button' class='btn btn-primary btn-sm ml-2' style='display:flex' >MARSONIK<span class='badge badge-success ml-1' style='display:inline' onclick='marsonik_disconnect_model();'> <i class='fa fa-check' style='font-size:15px;color:white'></i></span></button>"); 
                               
                                } 
                               
                                $("#verify_done").hide();
                            }
                            else{
                                setTimeout(function() { $("#verify_done a").trigger('click');}, 3000);
                                // user_auth="User has not completed authentication";
                                // $("#msg").html(user_auth);
                                // $("#msg").css("color", "red");
                                // alert("User has not completed authentication");
                            }
                            
                        }
                    });
                });     
            });
            $(".device_list").on('click',function(){
                var id=$(this).attr('id');
                $('.tab').removeClass('current');
                $("#tab_"+id).addClass('current');
            });

            $(document).ready(function() {
                
  $('#nobtn').click(function() {
    $('#'+device_ids+'1').prop('checked', true);
  });
});

            function clear_device(){
                $('#'+device_ids).val('');
                $('#'+device_ids).attr("disabled","true");
                $('#'+device_ids).css('border-color','#979b9f');
                $('#'+device_ids).attr('placeholder','');  
            }
            function assign_device(type){
             
                var serial_number_array=[];
                var pid='<?php echo $pid;?>';
                var errorcount=0;
                if(type=='connect')
                {
                    $(".assign-device-checkbox:checked").each(function(){
                    
                        var id = $(this).attr('data-id');
                        var device_id= $("#"+id).val();
                        
                        if(device_id==""){
                            errorcount++;
                            $(this).val('');
                            $('#'+id).css('border-color','red');
                            $('#'+id).attr('placeholder','Serial Number requierd');  
                            $('#'+id).addClass('your-class');             
                            
                        }
                        else{
                            
                            $('#'+id).css('border-color','#979b9f');
                            $('#'+id).attr('placeholder','');
                            $('#'+id).removeClass('your-class'); 
                            //device_id_array.push(device_id);
                        }
                    
                    });
                }
                //alert(errorcount);
                if(errorcount!=0){
                    return false;
                }
                $(".assign-device-serial-number").each(function(){ 
                                       
                    var serial_number=$(this).val();  
                    var device_id= $(this).attr('id'); 
                                    
                    // if(serial_number!='')
                    // {
                        var device_model='';
                        if(device_id=='iglucose_meter'){
                            device_model='Iglucose meter';

                        }
                        if(device_id=='pulse_oximeter'){
                            device_model='Pulse Oximeter';

                        }
                        if(device_id=='weighting_scale'){
                            device_model='Weighting scale';
                        }
                        if(device_id=='iblood_pressure'){
                            device_model='Blood Pressure';
                        }
                        device_data={
                            'device_model':device_model,
                            'device_serial_number':serial_number
                        }
                        serial_number_array.push(device_data);                        
                    //}
                });
                 if(serial_number_array.length!=0){

                    
                      $.ajax({
                        "async": true,
                        "crossDomain": true,
                        "url": "./devices.php?save_assign_devices",
                        "method": "POST",
                        data:{
                            pid:pid,
                            serial_number:serial_number_array
                        },
                        success: function(response) 
                        {
                            var data= JSON.parse(response);
                            
                            if(data.status=='success'){
                                $("#error_msg_show").html('');
                                var success_alert=data.success_msg;
                               
                                if(type=='disconnect')
                                {
                                    $(".assign-device-checkbox").each(function()
                                        {
                
                                        var id = $(this).attr('data-id');
                                        var device_id= $("#"+id).val();
                                        if(device_id==""){
                                            $(this).val('');                                        
                                        }
                                        else{
                                            $(this).val(device_id);                                        
                                        }
                                        
                                    });
                                }
                                if(type=='connect')
                                {
                                    if(success_alert>0){
                                        $(".assign-device-checkbox:checked").each(function()
                                        {
                
                                        var id = $(this).attr('data-id');
                                        var device_id= $("#"+id).val();
                                        if(device_id==""){
                                            $(this).val('');
                                        
                                        }
                                        else{
                                            $(this).val(device_id);                                        
                                        }
                                        
                                        });
                                       
                                    signerAlertMsg("Device Assign SuccessFully", 2000, 'success');
                                   
                                }
                                else{
                                    signerAlertMsg("Please Choose One device", 2000, 'danger');
                                }
                                }
                                
                                
                                
                            }
                            else{
                                var error_msg='';
                                $(data.error_msg).each(function( index,element ){
                                    error_msg+='<p style="color: #F6281C;" class="col-12"><i class="fas fa-exclamation-triangle"></i>'+element+'</p><br>';
                                    
                                });
                                $("#error_msg_show").html(error_msg);
                                
                            }
                        }
                    
                    });
                }
                // else{
                //     alert('empty');
                // }
            }
            function assign_email(){
                var email=$("#googlefit_mail").val();
                var pid='<?php echo $pid;?>';
                var errorcount=0;
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;   
                if(email==''){
                    $("#googlfit_err_msg").html('Enter googlefit email');
                    return false;
                }
                else
                {
                    if(!regex.test(email)){
                        $("#error_content").html('invalid  email');
                        return false;
                    }
                    else{
                        $.ajax({
                            "async": true,
                            "crossDomain": true,
                            "url": "./devices.php?assign_email",
                            "method": "POST",
                            data:
                            {
                                pid:pid,
                                email:email
                            },
                            success: function(response) 
                            {
                                var data= JSON.parse(response);
                                if(data.status=='success')
                                {
                                    $("#googlfit_err_msg").html('');
                                    googlefit_connected();
                                    // $("#model2").modal('show');
                                    //         setTimeout(function() { $("#model2").modal('hide');; }, 1000);
                                }
                                else{
                                    $("#googlfit_err_msg").html(data.msg);
                                }
                            },   
                        }); 
                    }
                    
                }
                  
                   
            }

$("#gconnected").click(function(){
    $("#gconnectedmodel").modal('show');
    $("#gconnectedmodel #error_content").html('<center>Do You Want to disconnect Google fit</center>');
    $("#gconnectedmodel .addaction").html('<button type="button" class="btn btn-primary btn-sm" onclick="disconnect('+"'"+'fit'+"'"+');">Yes</button>');
});
function model_view(){
    $("#gconnectedmodel").modal('show');
    $("#gconnectedmodel #error_content").html('<center>Do You Want to disconnect Google fit</center>');
    $("#gconnectedmodel .addaction").html('<button type="button" class="btn btn-primary btn-sm" onclick="disconnect('+"'"+'fit'+"'"+');">Yes</button>');
}
function model_view1(){
    $("#gconnectedmodel").modal('show');
    $("#gconnectedmodel #error_content").html('<center>Do You Want to disconnect *FREE STYLE LIBRE*</center>');
    $("#gconnectedmodel .addaction").html('<button type="button" class="btn btn-primary btn-sm" onclick="disconnect('+"'"+'LIBRE'+"'"+');">Yes</button>');   
}
function disconnect(action){
    var pid='<?php echo $pid;?>';
    if(pid){
        $.ajax({
            "async": true,
            "crossDomain": true,
            "url": "./devices.php?disconnect="+action,
            "method": "POST",
            data:
            {
                pid:pid
            },
            success: function(response) 
            {
                if(action == 'fit')
                {
                $("#googlefitsuccess").html('<button type="button" class="googlefit btn btn-primary btn-sm ml-2" value="GOOGLEFIT" onclick="googfitassign();" >GOOGLEFIT<span class="badge badge-danger span" style="display:inline"> <i class="fa fa-close gconnected" style="font-size:15px;color:white"></i></span></button>');
                // $("#verify_done").hide();
                // $("#success_msg").hide();
                // $('#msg').html('');
                // $("#gconnectedmodel").modal('hide');
                $('.gfitclass').addClass('googlefit');
                }
                if (action == 'LIBRE') 
                {
                $("#googlelibresuccess").html('<button type="button" class="myapp btn btn-primary btn-sm"  onclick="libree_connect()" id="libree_btn_con" value="FREESTYLELIBRE">FREESTYLELIBRE<span class="badge badge-danger" style="display:inline"> <i class="fa fa-close" style="font-size:15px;color:white"></i></span></button>');
                // $("#verify_done").hide();
                // $("#success_msg").hide();
                // $('#msg').html('');
                // $("#gconnectedmodel").modal('hide');
                }
                if (action == 'dexcom') 
                {
                    $("#dexcom_span").html("<button type='button' onclick='dexcom_connect()' id='dexcom_connect_btn' class='btn btn-primary btn-sm ml-2' style='display:flex' >DEXCOM<span class='badge badge-danger ml-1' style='display:inline'> <i class='fa fa-close' style='font-size:15px;color:white'></i></span></button>");
                    
                }
                if (action == 'marsonik') 
                {
                    $("#marsonik_span").html("<button type='button' onclick='marsonik_connect()' class='btn btn-primary btn-sm ml-2' style='display:flex' >MARSONIK<span class='badge badge-danger ml-1' style='display:inline'> <i class='fa fa-close' style='font-size:15px;color:white'></i></span></button>");
                    
                }
                if (action == 'omron') 
                {
                    $("#omron_span").html("<button type='button' onclick='omron_connect()' id='omron_connect_btn' class='btn btn-primary btn-sm ml-2' style='display:flex' >OMRON<span class='badge badge-danger ml-1' style='display:inline'> <i class='fa fa-close' style='font-size:15px;color:white'></i></span></button>");
                    
                }
                $("#verify_done").hide();
                    $("#success_msg").hide();
                    $('#msg').html('');
                    $("#gconnectedmodel").modal('hide');
               
            }
        });               

    }
    
}

function clear_email(type){
    
    var pid='<?php echo $pid;?>';
    var type=type;
    if(pid){
        $.ajax({
            "async": true,
            "crossDomain": true,
            "url": "./devices.php?disconnect_email",
            "method": "POST",
            data:
            {
                pid:pid,
                type:type
            },
            success: function(response) 
            {
                if(type=='googlefit'){
                    $('#googlefit_mail').val('');                   
                }
                if(type=='ambrosia'){
                    $('#Ambrosia_email').val('');
                    $('#Ambrosia_password').val('');
                }
                if(type=='tidepull')
                {     
                                 
                    $('#tidepull_email').val('');
                    $('#tidepull_password').val('');  
                }
                $('#clear_email_'+type).hide();
                
                
            }
        });               

    } 
}
// $('#googlefit_mail').keyup(function(){
//     if($(this).val()!=''){
//         $('#clear_email').show(); 
//     }
//     else{
//         $('#clear_email').hide();
//     }
//    // alert('ss');
// });
$('#Ambrosia_email').keyup(function(){
    if($(this).val()!=''){
        $('#ambrosia_err_msg').html('');
    }
});
$(function(){
var email=$('#googlefit_mail').val();
// if(email!=''){
//     $('#clear_email').show(); 
//     }
//     else{
//         $('#clear_email').hide();
//     }
});


            function assign_Ambrosia_email(){
                var email=$("#Ambrosia_email").val();
                var password=$("#Ambrosia_password").val();
                var user=$("#Ambrosia_user").val();
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
                var pid='<?php echo $pid;?>';
                var errorcount=0;
                if(email==''&& password==''){
                    $("#ambrosia_err_msg").html('All Field required');
                    return false;
                }
                else if(email==''){
                    $("#ambrosia_err_msg").html('Enter Ambrosia email');
                    return false;
                }
                else if(password==''){
                    $("#ambrosia_err_msg").html('Enter Ambrosia password');
                    return false;
                }
                
                else
                {
                    if(!regex.test(email))
                    {  
                        $("#ambrosia_err_msg").html('invalid  email');
                        return false;
                    }
                    else{
                        $.ajax
                        ({
                            "async": true,
                            "crossDomain": true,
                            "url": "./devices.php?assign_Ambrosia_email",
                            "method": "POST",
                            data:
                            {
                                pid:pid,
                                email:email,
                                password:password,
                                user:user
                            },
                            success: function(response) 
                            {
                                var data= JSON.parse(response);
                                
                                if(data.status=='success')
                                {
                                    $("#ambrosia_err_msg").html('');                                  
                                    signerAlertMsg('Ambrosiya Credentials Assign Successfully', 2000, 'success');
                                }
                                else{
                                    $("#ambrosia_err_msg").html(data.msg);
                                }
                            },   
                        }); 
                    }
                    
                }        
                   
            }

            function assign_tidepull(){               
                var email=$("#tidepull_email").val();               
                var password=$("#tidepull_password").val();
                var pid='<?php echo $pid;?>';
                var errorcount=0;
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;    
                if(email==''|| password==''){                    
                    $("#tidepull_email_msg").html('All field Required');
                    errorcount++;
                    return false;
                }
                else{
                    if(!regex.test(email)){  
                        $("#tidepull_email_msg").html('invalid email');
                        return false;
                    }
                    else
                    {
                        $.ajax
                        ({
                            "async": true,
                            "crossDomain": true,
                            "url": "./devices.php?assign_tidepull_email",
                            "method": "POST",
                            data:
                            {
                                pid:pid,
                                email:email,
                                password:password
                            },
                            success: function(response) 
                            {
                                var data= JSON.parse(response);
                                
                                if(data.status=='success')
                                {
                                    
                                    $("#tidepull_email_msg").html('');
                                    $("#model_error_content").html('*Tidepool* Successfully Connected');
                                    signerAlertMsg('*Tidepool* Successfully Connected', 2000, 'success'); 
                                    
                                }
                                else{
                                    $("#tidepull_email_msg").html(data.msg);
                                }
                            },   
                        }); 
                    } 
                }
            }

            /**bodytrace */
            function disconnect_devices(){
                clear_device();
                $("#error_msg_show2").html(' ');
                var value = $("#disconnect_device_value").val();
                // alert(value);
                if( value=="bodytrace"){
                    body_trace('bodytrace_discnt');
                }
                if(value=='tenovi'){
                    tenovi_device_connect('disconnect');
                }
                if(value=='smart_meter'){
                    assign_device('disconnect');
                }
                $('#cnfrm').css('display','none');
            }
            function body_trace(type){
             
                var serial_number_array=[];
                var pid='<?php echo $pid;?>';
                var errorcount=0;
                if(type=='connect')
                {
                    var bodytrace_connect_lenght=$('.body-trace-checkbox:checked').length;
                    if(bodytrace_connect_lenght>0)
                    {
                        $(".body-trace-checkbox:checked").each(function(){
                        
                            var id = $(this).attr('data-id');
                            var device_id= $("#"+id).val();
                            
                            if(device_id==""){
                                errorcount++;
                                $(this).val('');
                                $('#'+id).css('border-color','red');
                                $('#'+id).attr('placeholder','Serial Number requierd');  
                                $('#'+id).addClass('your-class');             
                                
                            }
                            else{
                                
                                $('#'+id).css('border-color','#979b9f');
                                $('#'+id).attr('placeholder','');
                                $('#'+id).removeClass('your-class'); 
                                //device_id_array.push(device_id);
                            }
                        
                        });
                    }
                    else
                    {
                        signerAlertMsg("Please Choose One device", 2000, 'danger');
                        return false;
                    }    
                }
                
                if(errorcount!=0){
                    return false;
                }
                $(".body-trace-serial-number").each(function(){ 
                                        
                    var serial_number=$(this).val();  
                    var device_id= $(this).attr('id'); 
                  
                    var device_model='';
                    if(device_id=='body_trace_weight')
                    {
                        device_model='Body Trace weight';

                    }
                    if(device_id=='pulse_meter'){
                        device_model='Pulse Meter';
                    }
                    device_data=
                    {
                    'device_model':device_model,
                        'device_serial_number':serial_number
                    }
                    serial_number_array.push(device_data);                        
                    
                });
                if(serial_number_array.length!=0){
                        $.ajax({
                            "async": true,
                            "crossDomain": true,
                            "url": "./devices.php?body_trace_devices",
                            "method": "POST",
                            data:{
                                pid:pid,
                                device_number:serial_number_array
                            },
                            beforeSend: function() {
                                if(type=='connect')
                                {
                                    $("#bodytrace_btn").prop("disabled", true);  
                                    
                                }

                            },
                            success: function(response) 
                            {
                            
                                var data= JSON.parse(response);
                                
                                if(data.status=='success'){
                                    $("#error_msg_show1").html('');
                                    var success_alert=data.success_msg;
                                // alert(success_alert);
                                    if(type=='bodytrace_discnt')
                                    {
                                        //alert(type); 
                                        $(".body-trace-checkbox").each(function()
                                            {
                                            
                                            var id = $(this).attr('data-id');
                                            var device_id= $("#"+id).val();
                                            if(device_id==""){
                                            // alert(device_id);
                                                $(this).val('');                                        
                                            }
                                            else{
                                                $(this).val(device_id);                                        
                                            }
                                            
                                        });
                                    }
                                    if(type=='connect')
                                    {
                                        $("#bodytrace_btn").removeAttr("disabled"); 
                                        if(success_alert>0)
                                        {
                                            $(".body-trace-checkbox:checked").each(function()
                                            {
                    
                                                var id = $(this).attr('data-id');
                                                var device_id= $("#"+id).val();
                                                if(device_id==""){
                                                    $(this).val('');                                            
                                                }
                                                else{
                                                    $(this).val(device_id);                                        
                                                }
                                            
                                            });
                                            signerAlertMsg("Device Assign SuccessFully", 2000, 'success');                                        
                                        }
                                        else{
                                            signerAlertMsg("Please choose any one device", 2000, 'danger');
                                        }
                                    }
                                    
                                    
                                    
                                }
                                else{
                                    var error_msg='';
                                    $(data.error_msg).each(function( index,element ){
                                        error_msg+='<p style="color: #F6281C;" class="col-12"><i class="fas fa-exclamation-triangle"></i>'+element+'</p><br>';
                                        
                                    });
                                    $("#error_msg_show1").html(error_msg);
                                    
                                }
                            }
                    
                        });
                }
          
            }

            var device_ids;
            $(".body-trace-checkbox").change(function(){
                var id = $(this).attr('data-id');
                var value=$(this).val();
                var text = $(this).attr('class');
                if(text=='body-trace-checkbox'){
                    $("#disconnect_device_value").val('bodytrace');
                }
                device_ids = id;
                if($(this).is(":checked")){
                    
                    $('#'+id).removeAttr("disabled");
                    $('#'+id).css('border-color','#979b9f');
                    $('#'+id).attr('placeholder','');
                }
                else{
                    if(value!=''){
                        $("#cnfrm").css("display","block");
                        
                    }
                    else{
                        $('#'+id).css('border-color','#979b9f');
                        $('#'+id).attr('placeholder','');
                        $('#'+id).val('');
                        $('#'+id).prop('disabled', true);
                    }
                    
                    
                }
            });
            /**bodytrace */
            /**tenovi */
            function tenovi_device_connect(type){
                //$("#disconnect_tenovi_value").val('tenovi');
                $("#error_msg_show2").html(' ');
                var serial_number_array=[];
                var pid='<?php echo $pid;?>';
                var errorcount=0;
                if(type=='connect')
                {
                    var tenovi_connect_lenght=$('.tenovi-device-checkbox:checked').length;
                    if(tenovi_connect_lenght>0)
                    {
                        $(".tenovi-device-checkbox:checked").each(function(){
                    
                        var id = $(this).attr('data-id');
                        var device_id= $("#"+id).val();
                        
                        if(device_id==""){
                            errorcount++;
                            $(this).val('');
                            $('#'+id).css('border-color','red');
                            $('#'+id).attr('placeholder','Serial Number requierd');  
                            $('#'+id).addClass('your-class');             
                            
                        }
                        else{
                            
                            $('#'+id).css('border-color','#979b9f');
                            $('#'+id).attr('placeholder','');
                            $('#'+id).removeClass('your-class'); 
                            
                        }
                    
                        });


                    }
                    else{
                        
                        signerAlertMsg("Please Choose One device", 2000, 'danger');
                        return false;
                    }
                    if(errorcount>0){
                        return false;
                    }  
                }
                
                
                $(".tenovi-serial-number").each(function(){ 
                                        
                    var serial_number=$(this).val();  
                    var device_id= $(this).attr('id'); 
                    var device_model='';
                    if(device_id=='tenovi_bpm'){
                        device_model='Tenovi BPM';
                    }
                    if(device_id=='tenovi_ox'){
                        device_model='Tenovi Pulse Ox';

                    }
                    if(device_id=='tenovi_glucometer'){
                        device_model='Tenovi Glucometer';
                    }
                    if(device_id=='tenovi_scale'){
                        device_model='Tenovi Scale';
                    }
                    if(device_id=='tenovi_flow'){
                        device_model='Tenovi Peak Flow Meter';
                    }
                    device_data={
                        'device_name':device_model,
                        'device_serial_number':serial_number
                    }
                    serial_number_array.push(device_data);                        
                    
                });
                //console.log(serial_number_array);
                $.ajax
                ({
                    "async": true,
                    "crossDomain": true,
                    "url": "./devices.php?tenovi_add_device&type="+type+"",
                    "method": "POST",
                    data:
                    {
                         pid:pid,
                         device_id:serial_number_array
                    },
                    beforeSend: function() {
                        if(type=='connect')
                        {
                            $("#tenovi-device-button").prop("disabled", true);  
                            $('#tenovi_loader').removeClass("far fa-check-circle");
                            $('#tenovi_loader').addClass("fa fa-spinner fa-spin");
                        }

                    },
                    success: function(response) 
                    {
                        if(type=='disconnect')
                        {
                            $(".tenovi-device-checkbox").each(function()
                                {
        
                                var id = $(this).attr('data-id');
                                var device_id= $("#"+id).val();
                                if(device_id==""){
                                    $(this).val('');                                        
                                }
                                else{
                                    $(this).val(device_id);                                        
                                }
                                
                            });
                        }
                        if(type=='connect')
                        {
                            $("#tenovi-device-button").removeAttr("disabled"); 
                            $('#tenovi_loader').removeClass("fa fa-spinner fa-spin");
                            $('#tenovi_loader').addClass("far fa-check-circle");                      
                            var data= JSON.parse(response);                        
                            if(data.status=='success')
                            { 
                                if(type=='tenovi_diconnect')
                                {
                                    
                                    $(".tenovi-device-checkbox").each(function()
                                    {
                                        
                                        var id = $(this).attr('data-id');
                                        var device_id= $("#"+id).val();
                                        if(device_id==""){                                     
                                            $(this).val('');                                        
                                        }
                                        else{
                                            $(this).val(device_id);                                        
                                        }
                                        
                                    });
                                }
                                if(type=='connect')
                                {
                                    var reurn_msg='';
                                    $(data.message).each(function( index,element )
                                    {
                                        if(element.status=='error')
                                        {
                                            reurn_msg+='<p style="color: #F6281C;" class="col-12"><i class="fas fa-exclamation-triangle"></i>'+element.message+'</p><br>';
                                        }
                                        else{
                                            reurn_msg+='<p style="color: green;" class="col-12"><i class="far fa-check-circle"></i>'+element.message+'</p><br>';
                                        }
                                    });
                                    
                                $("#error_msg_show2").html(reurn_msg);
                                }
                                
                            }
                            else{
                                var error_msg='';
                                $(data.message).each(function( index,element ){
                                    error_msg+='<p style="color: #F6281C;" class="col-12"><i class="fas fa-exclamation-triangle"></i>'+element+'</p><br>';
                                    
                                });                            
                                $("#error_msg_show2").html(error_msg);
                                
                            }

                        }
                        
                    }
                 
                });
            }
        
            var device_ids;
            $(".tenovi-device-checkbox").change(function(){
                var id = $(this).attr('data-id');
                var value=$(this).val();
                var text1 = $(this).attr('class');
                if(text1=='tenovi-device-checkbox'){
                    
                    $("#disconnect_device_value").val('tenovi');
                }
                device_ids = id;
                if($(this).is(":checked")){
                   
                 $('#'+id).removeAttr("disabled");
                 $('#'+id).css('border-color','#979b9f');
                    $('#'+id).attr('placeholder','');
                }
                else{
                    if(value!=''){
                        $("#cnfrm").css("display","block");
                        
                    }
                    else{
                        $('#'+id).css('border-color','#979b9f');
                    $('#'+id).attr('placeholder','');
                    $('#'+id).val('');
                    $('#'+id).prop('disabled', true);
                    }
                    
                    
                }
            });
     
        </script>

            <!----googfit device assign--->
                    <!-- Modal -->
<div class="modal fade" id="googfitassign" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-body">
      <div class="row">
                                    <div class="col-12">
                                    <label>Enter Googlefit Email:</label>
                                    <div style="display:flex;">
                                     <input type="text" id="googlefit_mail" value="<?php echo $patient_data['googlefit_email']?$patient_data['googlefit_email']:'';?>" class="form-control" style="width:50% !important;">
                                     <?php
                                     $googlefit_gmail=$patient_data['googlefit_email']?$patient_data['googlefit_email']:'';
                                     if($googlefit_gmail!=''){
                                        $googlefit_display='block';
                                     }
                                     else{
                                        $googlefit_display='none';
                                     }
                                     ?>
                                     <i class="fa fa-close" id='clear_email_googlefit' onclick="clear_email('googlefit')" style="margin: 10px;margin-left:-18px;display:<?php echo $googlefit_display;?>;font-size:15px;color:red"></i>
                                     </div>
                                    </div>
                                </div>
                                <div class="row col-12" id="googlfit_err_msg">
                                </div>
                                <div class="row col-12 mt-2">
                                    
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary mr-3" onclick="assign_email();" id="assign_gmail">
                                                <i class="far fa-check-circle " id="circle_g" ></i> Assign
                                        </button>
                                                
                                    </div>
                                    <div class="form-group">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
      </div>
      <div class="modal-footer" style="justify-content:center;">
      
      </div>
    </div>
  </div>
</div>

<!-- authentication model -->
<div class="modal fade" id="gconnectedmodel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="width:140% !important;">
     
      <div class="modal-body" style="padding:40px;">
       <b id="error_content"><center>Do You Want to disconnect Google fit</center></b>
      </div>
      <div class="modal-footer" style="justify-content:center;">
      <div class="mt-3 addaction">
        <button type="button" class="btn btn-primary btn-sm" onclick="disconnect();">Yes</button>
      </div>
      <div class="mt-3">
      <button type="button" class="btn btn-danger  btn-sm" data-dismiss="modal">No</button>
       
      </div>
    </div>
  </div>  
</div>



    </body>
</html>
