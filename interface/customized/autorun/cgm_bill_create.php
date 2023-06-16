<?php
$ignoreAuth = 1;
require_once("../../globals.php");
require '../../login/PHPMailerAutoload1.php';
use OpenEMR\Core\Header;
use Mpdf\Mpdf;
$mpdf = new mPDF();
// $esign='data:image/png;base64,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';
// $html="<br><img src='".$esign."' style='width:20%;height:80px;'>";
// echo $html;exit();
function insert_billing($code,$encounter,$pid){
        
    $code_text='CGM Code';
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
}
$report_id=isset($_GET['report_id'])?$_GET['report_id']:'';
if(isset($_GET['genreate_report']))
{
    $response=[];
    $report_value=base64_decode($_POST['report_value']);  
    $libre_report_id=$_POST['report_id'];  
    $esign=$_POST['esign'];
   
    $html='';
    if($libre_report_id!='')
    {
        
        $libre_data=sqlQuery("SELECT CONCAT(u.fname, ' ', u.lname) as user_name,CONCAT(pd.fname, ' ', pd.lname)
        as patient_name,pd.DOB as pat_dob,pd.phone_home as pat_phone,tr.* FROM terra_user as tr left join patient_data as pd on pd.pid=tr.pid left join users
         as u on u.id=tr.auth_user_id WHERE tr.id=".$libre_report_id."");
        if(!empty($libre_data))
        {
            $patient_name=$libre_data['patient_name'];
            $dob=date('m/d/Y', strtotime($libre_data['pat_dob']));
            $phone=isset($libre_data['pat_phone'])&&$libre_data['pat_phone']!=''?$libre_data['pat_phone']:'Nil';
            $user_name=$libre_data['user_name'];
            $sensor_start_date=$libre_data['assign_date']; 
            $sensor_end_date=date('Y-m-d', strtotime($sensor_start_date. ' + 30 days'));
            $pid=isset($libre_data['pid'])?$libre_data['pid']:'';            
            $receipt_id=isset($libre_data['auth_user_id'])?$libre_data['auth_user_id']:'';
            $today_date=date('Y-m-d');
            $pat_encounter=sqlQuery("SELECT * FROM form_encounter where pid='".$pid."' AND encounter_status='open' AND date_end!='NULL'");
            $encounter=isset($pat_encounter['encounter'])?$pat_encounter['encounter']:'';
            $code='95251';
            insert_billing($code,$encounter,$pid);
            $updated_date=date('Y-m-d', strtotime($today_date. ' + 1 days')); 
            sqlStatement("UPDATE terra_user SET report_sent=0,assign_date='".$updated_date."' WHERE id='".$libre_report_id."'");
        }
        $glucose_report_name='Glucose Report '.date('m/d/Y', strtotime($sensor_start_date)).' to '.date('m/d/Y', strtotime($sensor_end_date));
        $html.='<div><h3 align="center"><strong>'.$glucose_report_name.'</strong></h3></div>
        <div style="width: 100%; margin-top:10px" >
            <div align="left" style="width: 50%;float: left;">Patient Name: '.$patient_name.'</div>
            <div align="left" style="width: 50%;float: left;">Patient DOB: '.$dob.'</div>
        </div>
        
        <div style="width: 100%;" >
            <div align="left" style="width: 50%;float: left;">Patient Phone: '.$phone.'</div>
            <div align="left" style="width: 50%;float: left;">Doctor : '.$user_name.'</div>
        </div>';
        $html.='<div style="margin-top:10px;">'.$report_value.'</div><br>';
        $sign="<img src='".$esign."' style='width:20%;height:80px;'>";
        $html.='<div><div style="width: 100%;" ><div>Doctor Sign</div><div>'.$sign.'</div></div></div>';
        
        $site=isset($_SESSION['site_id'])?$_SESSION['site_id']:'';            
        $dir=$GLOBALS['OE_SITES_BASE'].'/'.$site.'/documents/'.$pid.'/';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        //echo $GLOBALS['OE_SITES_BASE'];exit();
        $body = ob_get_contents();
        $doc_id = generate_id(); 
        ob_end_clean();
        $mpdf->setTitle("Glucose Weekly report");
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->SetHTMLHeader($header);
        $mpdf->WriteHTML($html);
        $mpdf->defaultfooterline = 0;
        $report_name=$sensor_start_date.'to'.$sensor_end_date.'_'.$doc_id.'_glucose Report.pdf';
        $pdf= $dir.$report_name;
        $mpdf->Output($pdf, 'F');
        $date=date('Y-m-d H:i:s');
        $type= 'file_url';
        $mime_type='application/pdf';
        $doc_name='Glucose Report';
        $cat_id=31;
        $documents_cat=sqlInsert("INSERT INTO categories_to_documents(category_id,document_id)
                VALUES($cat_id,$doc_id )");
        $document_insert=sqlInsert("INSERT INTO documents(id,url,type,date,mimetype,owner,name,revision,foreign_id)
        VALUES(?,?,?,?,?,?,?,?,?)",array($doc_id,$pdf,$type,$date,$mime_type,1,$doc_name, $date,$pid));
        $response['status']='success';
        $response['message']='Report Submitted Successfully';
      
              
    } 
    else{
        $response['status']='error';
        $response['message']='Empty Report Id ';
    }
    echo json_encode($response);
    die();
}
$report_table_value='';
if($report_id)
{
    $libre_data=sqlQuery("SELECT CONCAT(u.fname, ' ', u.lname) as user_name,u.email as useremail,pd.email as patemail,CONCAT(pd.fname, ' ', pd.lname)
     as patient_name,pd.DOB as pat_dob,pd.phone_home as pat_phone,tr.* FROM terra_user as tr left join patient_data as pd on pd.pid=tr.pid left join users
      as u on u.id=tr.auth_user_id WHERE tr.id=".$report_id."");
    if(!empty($libre_data))
    {
        $sent_flag=isset($libre_data['report_sent'])?$libre_data['report_sent']:0;      
        $sensor_start_date=$libre_data['assign_date'];  
        $pid=isset($libre_data['pid'])?$libre_data['pid']:'';
        $receipt_id=isset($libre_data['auth_user_id'])?$libre_data['auth_user_id']:'';
        $today_date=date('Y-m-d');         
        $sensor_end_date=date('Y-m-d', strtotime($sensor_start_date. ' + 30 days'));
        $patient_name=$libre_data['patient_name'];
        $dob=date('m/d/Y', strtotime($libre_data['pat_dob']));
        $phone=isset($libre_data['pat_phone'])&&$libre_data['pat_phone']!=''?$libre_data['pat_phone']:'Nil';
        $user_name=$libre_data['user_name'];
        $glucose_report_name='Glucose Report '.date('m/d/Y', strtotime($sensor_start_date)).' to '.date('m/d/Y', strtotime($sensor_end_date)) .' for '.$patient_name;
        $date_array=[];
        if(strtotime($sensor_end_date)<=strtotime($today_date)&&$sent_flag==1)        
        {
            $libre_query=sqlStatement("SELECT * FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='Terra_Api'  AND reading_date BETWEEN '".$sensor_start_date."' AND '".$sensor_end_date."' GROUP BY reading_date");
            while($row=sqlFetchArray($libre_query))
            {
                //$date_array[]=date('m/d/Y', strtotime($sensor_start_date))$row['reading_date'];
                $date=$row['reading_date'];
                $report_table_value.='<tr><td colspan="3"><strong>'.date('m/d/Y', strtotime($date)).'</strong></td></tr>';
                $libre_all_data=sqlStatement("SELECT reading_time,blood_glucose,pid,reading_date FROM api_vitals_data WHERE pid = '".$pid."' AND api_type='Terra_Api' AND reading_date='".$date."'");
                
                while($value=sqlFetchArray($libre_all_data))
                {
                    if($value['blood_glucose']>130){
                        $text='High';
                    }
                    else if($value['blood_glucose']>=100 && $value['blood_glucose']<=125){
                        $text='Normal';
                    }
                    else if($value['blood_glucose']>=95 && $value['blood_glucose']<=99){
                        $text='Midly Low';
                    }
                    else if($value['blood_glucose']>=126 && $value['blood_glucose']<=130){
                        $text='Midly High';
                    }
                    else if($value['blood_glucose']<95){
                        $text='Low';
                    }
                    $report_table_value.='<tr>
                    <td>'.date('H:i:s', strtotime($value['reading_time'])).'</td>
                    <td>'.$value['blood_glucose'].'</td>
                    <td>'.$text.'</td>
                    </tr>';

                }
                

            }
            
        }
       
        else{
            if(strtotime($sensor_end_date)>strtotime($today_date)){
                echo "<center><h2>No time for sign document.Thank You!</h2></center>";
                die();
            }
            echo "<center><h2>Receipt ".$libre_data['user_name'] ." Already Sign Document.Thank You!</h2></center>";
            die();
        }
    }
    else{
        echo "No Matching Record.'";
        die();
    }

}
else{
    
    echo "<center><h2>No report Id for Authentication</h2></center>";
    die();
}
?>
<html>
<head>
<title><?php echo xlt("Patient libree Report"); ?></title>

 <?php Header::setupHeader(['datetime-picker', 'common']); ?>
 <link rel="stylesheet" href="../../public/esign/assets/css/jquery.signature.css"> 
</head>
    <body>
        <div class="container">
           
            <h3 class="mt-3"><center><?php echo $glucose_report_name;?></center></h3>
            <div style="margin-top:20px;">
                <div class="row" >
                    <div class="col-6"><p>Patient Name:<?php echo $patient_name ?></p></div>
                    <div class="col-6"><p>Patient DOB:<?php echo $dob; ?></p></div>
                </div>
                <div class="row">
                    <div class="col-6"><p>Phone:<?php echo $phone; ?></p></div>
                    <div class="col-6"><p>Doctor:<?php echo $user_name; ?></p></div>
                </div>
            </div>
            <div class="mt-2" id="generate_value">

                <table class="table" border='1' style="width:100%;" Cellspacing="0px" cellpadding="8px" >
                    <tr>
                        <th>Date</th>
                        <th>Glucose</th>
                        <th>Status</th>
                    </tr>
                    <?php echo $report_table_value;?>
                </table>
            </div>
            <div class="row">
                    <div id="img_val" class="col-6">
                        Doctor Sign:<i class="fas fa-pen pen_icon" ></i>
                        <input type="hidden" name="esign" id="esign">
                        <img src='' class="img" id="img_esign" style="display:none;height:90px;"                      >
                    </div>
            </div>
           
            <div class="row mt-2" style="justify-content:center;">
                <button type="button" class="btn btn-primary" id="save_form">submit</button>
            </div>  
            
        </div>
    </body> 
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="col-md-12" style="display: flex;justify-content: center">
                            <div id="sig">
                                <img id="view_img" style="display:none" width='380px' height='144px'>
                            </div>
                            <br />
                            <br />
                            <br />
                            <!-- <button id="clear">Clear</button> -->
                            <textarea id="sign_data" style="display: none"></textarea>
                        </div>
                        <div class="container">
                        <div class="mt-2 row" style="display: flex;justify-content: center">
                            <div class="m-2"><button id="clear" class="btn btn-primary">Clear</button></div>
                            <div class="m-2"><input type='button' id="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign'></div>
                            
                        </div>
                        </div>
                        
                        

                    </div>
                </div>
            </div>
        </div>
    <!-- modal close -->
</html>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../public/esign/assets/js/jquery.signature.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" ></script>

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
        var sig = $('#sig').signature({
            syncField: '#sign_data',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#view_img").attr("src", '');
            $("#view_img").css('display','none');
            $('canvas').css('display','block');
            $("#sign_data").val('');
            $("#esign").val('');
            $("#img_esign").css('display','none');
            //$("#img_esign").attr("src", '');
        });
    
        $('.pen_icon').click(function() {
            id_name = $(this).next('input').attr('id');
            var sign_value = $("#"+id_name).val();
            if(sign_value!='')
            {
                // $("#sig").css('display','none');
                $('canvas').css('display','none');
                $("#view_img").css('display','block');
                $("#view_img").attr("src", sign_value);
                $("#sign_data").val(sign_value);

            }
            $("#myModal").modal('show');
        });
        $('#add_sign').click(function() {
            var sign = $('#sign_data').val();
            $('#' + id_name).val(sign);
            if(sign!='')
            {
                $("#img_"+id_name).attr('src',sign);
                $("#img_"+id_name).css('display','block');
            }
            else{
                alert('please fill esign');
                return false;
                $("#esign").val('');
                $("#img_"+id_name).css('display','none');
            }

            $('#sign_data').val('');
            sig.signature('clear');
        
        });
        $("#save_form").on('click',function()
        {
            var esign = $("#esign").val() ;
            var esign_val=btoa($("#img_val").html());
            var report_value=btoa($("#generate_value").html()); 
            var report_id='<?php echo $report_id ?>';          
            if(esign!='')
            {
                $.ajax({
                    url:'./cgm_bill_create.php?genreate_report=true',
                    method:'post',
                    data:{
                        
                        report_value:report_value,
                        report_id:report_id,
                        esign:esign
                    },
                    beforeSend: function() {                            
                        $("#save_form").prop("disabled", true);                            
                    },
                    success:function(data){
                        $("#save_form").removeAttr("disabled");  
                        var response=jQuery.parseJSON(data);
                        var message=response.message;
                        if(response.status=='success'){
                            
                            signerAlertMsg(message, 2000, 'success');
                            window.close();
                        }
                        else{
                            signerAlertMsg(message, 2000, 'danger');
                        }                       
                        
                    }
                });
               
            }
            else{
                signerAlertMsg('Please sign here before document submit', 2000, 'danger');
                return false;
            }

        });
    </script>
    
<?php
die();

?>