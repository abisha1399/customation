<?php
require_once(__DIR__ . "/../globals.php");
require 'PHPMailerAutoload1.php';
use PHPMailer\PHPMailer\PHPMailer;
use OpenEMR\Common\Crypto\CryptoGen;
$cryptoGen = new CryptoGen();
function pdf_form($rootdir,$form_name,$formdir,$form_id){
    $result= "<a class='btn btn-primary btn-sm' title='" . xla('pdf this form') . "' " .
            "onclick=\"return openpdfForm(" . attr_js($formdir) . ", " .attr_js($form_name) . ", " . attr_js($form_id) . ")\">";
    $result.= "" . xlt('PDF') . "</a>";
    return $result;
   
}
function formSubmit_new($tableName, $values, $id)
{
    global $attendant_type;

    $sqlBindingArray = [$id];
    $sql = "insert into " . escape_table_name($tableName) . " set " .  escape_sql_column_name($attendant_type, array($tableName)) . "=?, date = NOW(),";
    foreach ($values as $key => $value) {
        if ($key == "csrf_token_form") {
            continue;
        }
        if (strpos($key, "openemr_net_cpt") === 0) {
            //code to auto add cpt code
            if (!empty($value)) {
                $code_array = explode(" ", $value, 2);

                BillingUtilities::addBilling(date("Ymd"), 'CPT4', $code_array[0], $code_array[1], $_GET['id']);
            }
        } elseif (strpos($key, "diagnosis") == (strlen($key) - 10) && !(strpos($key, "diagnosis") === false )) {
            //case where key looks like "[a-zA-Z]*diagnosis[0-9]" which is special, it is used to auto add ICD codes
            //icd auto add ICD9-CM
            if (!empty($value)) {
                $code_array = explode(" ", $value, 2);
                BillingUtilities::addBilling(date("Ymd"), 'ICD9-M', $code_array[0], $code_array[1], $_GET['id']);
            }
        } else {
            $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
            $sqlBindingArray[] = $value;
        }
    }

    $sql = substr($sql, 0, -1);
    return sqlInsert($sql, $sqlBindingArray);


}
function formUpdate_new($tableName, $values, $id,$pid)
{
    $sqlBindingArray = [];

    $sql = "update " . escape_table_name($tableName) . " set pid =$pid, date = NOW(),";
    foreach ($values as $key => $value) {
        if ($key == "csrf_token_form") {
            continue;
        }
        $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
        $sqlBindingArray[] = $value;
    }

    $sql = substr($sql, 0, -1);
    $sql .= " where id=?";
    $sqlBindingArray[] = $id;
    return sqlInsert($sql, $sqlBindingArray);
}
function encsubmit($tableName, $values)
{
    $sqlBindingArray = [];
    $sql = "insert into " . escape_table_name($tableName) . " set ";
    foreach ($values as $key => $value) {      
        $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
        $sqlBindingArray[] = $value;        
    }
    $sql = substr($sql, 0, -1);   
    return sqlInsert($sql, $sqlBindingArray);
}
function billing_profile_main(){
   $result='<div class="container"  style="margin-top:20px">
        <div class="form-group row">
           <label for="code_text" class="col-form-label col-form-label-sm col-md-2">Level Of Care:</label>
           <div class="col-md">
               <button class="btn btn-primary btn-sm" type="button" onclick="view_profile(0);">
                        Add Billing Profile
                </button>
                
           </div>
        </div> 
        <div class="row">
        <table class="table table-borderless" cellpadding="5" cellspacing="0">
            <tr style="background-color: #aaaac9;">
            <td><span class="font-weight-bold">Profilename</span></td>
            <td><span class="font-weight-bold">ICD-10</span></td>
            <td><span class="font-weight-bold">CPT</span></td>
            <td><span class="font-weight-bold">HCPCS</span></td>
            <td><span class="font-weight-bold">Updated Date</span></td>
            <td><span class="font-weight-bold">Action</span></td>
            </tr>';

           
                  $billing_profile= Sqlstatement("SELECT * FROM billing_profile where is_deleted=0");
                 
                  while($row=sqlFetchArray($billing_profile)){
                     
                    $codes= json_decode($row['codes']);
                     //echo'<pre>';print_r($codes);
                     $icd10_code_name='';
                     $cpt_code_name='';
                     $hcpcs_code_name='';

                     foreach($codes as $code)
                     {
                        
                        if($code->codename=='ICD10')
                        {
                           $icd10_code_name.=$code->code.',';  
                        }
                        if($code->codename=='CPT4')
                        {
                           $cpt_code_name.=$code->code.',';  
                        }
                        if($code->codename=='HCPCS')
                        {
                           $hcpcs_code_name.=$code->code.',';  
                        }
                        
                     }
                     date_default_timezone_set('Asia/Kolkata');
                     $my_datetime = $row['update_date'];
                     $updated_date= date('d-m-Y h:i A',strtotime('-5 hour +00 minutes',strtotime($my_datetime)));
                     
            
            $result.='<tr id="profile_box_'.$row['id'].'">';
            
              $icd10_code_name=rtrim($icd10_code_name,',');
              $cpt_code_name=rtrim($cpt_code_name,',');
              $hcpcs_code_name=rtrim($hcpcs_code_name,',');
                                              
            $result.='<td>'.$row['profile_name'].'</td>
            <td>'.$icd10_code_name.'</td>
            <td>'.$cpt_code_name.'</td>
            <td >'.$hcpcs_code_name.'</td>            
            <td >'.$updated_date.'</td>
            <td><i class="fa fa-pen" style="color:blue;" onclick="view_profile('.$row['id'].')"></i>
           &nbsp;&nbsp;&nbsp;<i class="fa fa-trash" style="color:red;" onclick="delete_profile('.$row['id'].')"></td>

            </tr>';
            
            }
                         
        $result.='</table>
                
    </div>';
    return $result; 
}
if(!empty($_POST['profile_id']))
{
    $id=$_POST['profile_id'];
    Sqlstatement("UPDATE billing_profile SET is_deleted=1 WHERE id='".$id."'");
    echo '1';
    exit();
}
function add_billing_profile($encounter,$id,$pid,$eid){
    //echo $id;exit();
    if(!empty($id))
    {
        sqlStatement("DELETE FROM billing WHERE appt_id='".$eid."'");
        $patient_profile_data=sqlStatement("SELECT * FROM billing_profile WHERE id ='".$id."' AND is_deleted=0");
        sqlStatement("UPDATE form_encounter Set pat_profile_data='".$id."' WHERE encounter='".$encounter."'");
        $patient_data_array=[];
        if(!empty($patient_profile_data)){
            while($patient_data=sqlfetchArray($patient_profile_data)){
                $patient_data_array[]=$patient_data;
                
            }
        }
        
        $patient_code=[];
        if(!empty($patient_data_array)){
            foreach($patient_data_array as $value){
                $patient_code[]=$value['codes'];
            }
        
        }
        
        $value=json_decode($patient_code[0]);
        
        foreach($value as $key){
                
            $code=$key->code;
            $code_text=$key->decription;
            $modifier='';
            $units=$key->unit?$key->unit:" ";
            $fee = $key->fee?$key->fee:"0.00";
            $ndc_info = '';
            $justify = '';
            $billed = 0;
            $notecodes = '';
            $pricelevel = '';
            $revenue_code = "";
            $code_type=$key->codename;
            
            $sql = "INSERT INTO billing (date, encounter, code_type, code, code_text, " .
            "pid, authorized, user, groupname, activity, billed, provider_id, " .
            "modifier, units, fee, ndc_info, justify, notecodes, pricelevel, revenue_code,appt_id) VALUES (" .
            "NOW(), ?, ?, ?, ?, ?, ?, ?, ?,  1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
            $insert_id=sqlInsert($sql, array($encounter, $code_type, $code, $code_text, $pid, 1,
                $_SESSION['authUserID'], $_SESSION['authProvider'], 0, 0, $modifier, $units, $fee,
                $ndc_info, $justify, $notecodes, $pricelevel, $revenue_code,$eid));

        } 
    }
   
}
function billing_profile_select($pat_profile_id){
    $result='
    <div id="pat_profile_div" class="m-2">
    <label for="form_group">Billing Profile:</label>';        
        $patient_profile_data=sqlStatement("SELECT * FROM billing_profile WHERE is_deleted=0");
        $patient_data_array=[];
        if(!empty($patient_profile_data)){
    
            while($patient_data=sqlfetchArray($patient_profile_data)){
                $patient_data_array[]=$patient_data;
            }
        }
           $result.='<select name="pat_profile_data"  class="form-control form-control-sm ml-2" id="pat_profile_data" style="width:98%;">
            <option value=0>--Select One--</option>';
            if(empty($patient_data_array))
            {
                $result.='<option> No Level Of Care</option>';
            }
           else
            {
                foreach($patient_data_array as $value)
                {
                    if($value['id']==$pat_profile_id)
                    {
                        //echo'<pre>';print_r($pat_profile_id)
                        $result.='<option value='.$value['id'].' selected>'.$value['profile_name'].'</option>';     
                    }
                    else
                    {
                        $result.='<option value='.$value['id'].'>'.$value['profile_name'].'</option>';

                    }
                    

                }
            }
            $result.='</select>';
      

    $result.='</div> ';
    return $result;
}
function send_mail($id, $pid)
{
    if($id){
    
        //print_r($encounter);die;
        $pdata = sqlQuery("SELECT email,fname,lname FROM patient_data where pid=?", array($pid));
        $name = $pdata['fname'].' '.$pdata['lname'];
        $to = $pdata['email'];
        $vBody ="Hi ".$name." find the attachment for your <b>'".$id."'</b> encounter form PDF <br><br>
        Best regards,<br>Capminds";
        
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
        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL;                 // SMTP username
        $mail->Password = PASS;                           // SMTP password
        $mail->SMTPSecure = $secure;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $port;
        $mail->isHTML(true);
        $mail->setFrom(EMAIL, "capminds");
        $mail->addAddress($to);             // Name is optional
        $mail->addReplyTo(EMAIL);        
        $mail->MsgHTML("<html><body><div class='wrapper'>" . $vBody . "</div></body></html>");
        $mail->AddAttachment($GLOBALS['OE_SITE_DIR'].'/documents/cnt/Patient_Orientation_Manual_Emr.pdf', $name = 'Patient Orientation Manual Emr',  $encoding = 'base64', $type = 'application/pdf');
        $mail->AddAttachment($GLOBALS['OE_SITE_DIR'].'/documents/cnt/Medication_Disposal_Packet_Emr.pdf', $name = 'Medication Disposal Packet Emr',  $encoding = 'base64', $type = 'application/pdf');
        $mail->isSMTP(); 
        $mail->Subject = "Encounter pdf"; 
        if($to!='')
        {
            $mail->send();
        }       
        
    }
   
}

?>