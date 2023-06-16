<?php


$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code
$sessionAllowWrite = true;
require_once("../globals.php");
require_once("$srcdir/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
use Mpdf\Mpdf;
$mpdf = new mPDF();
if(isset($_GET['insert_id']))
{  
    
    $pid=isset($_POST['pid'])?$_POST['pid']:7;
    $esign=isset($_POST['esign'])?$_POST['esign']:'';
    $participate_name=isset($_POST['participate_name'])?$_POST['participate_name']:'';
    $name=isset($_POST['name'])?$_POST['name']:'';
    $date=isset($_POST['date'])?$_POST['date']:'';    
    $program_name=isset($_POST['program_name'])?$_POST['program_name']:'';
    if(isset($_GET['insert_id'])&&$_GET['insert_id']=='portal'){
    $folderPath =   $GLOBALS['OE_SITES_BASE'].'../../interface/customized/sign/'.$pid.'/';
    if(!is_dir($folderPath))
    {      
        mkdir($folderPath,0755,true);
    }
    //echo $folderPath; 
    $image_parts = explode(";base64,", $esign);
    
    $image_type_aux = explode("image/", $image_parts[0]);
    
    $image_type = $image_type_aux[1];
    
    $image_base64 = base64_decode($image_parts[1]);
    $file_name=$pid.uniqid() . '.'.$image_type;
    $file = $folderPath .$file_name;

    file_put_contents($file, $image_base64);
    }
    $hostname=isset($sqlconf['host'])?$sqlconf['host']:'mariadb-c1';
$port=isset($sqlconf['port'])?$sqlconf['port']:'openemr';
$username=isset($sqlconf['login'])?$sqlconf['login']:'openemr';
$password=isset($sqlconf['pass'])?$sqlconf['pass']:'openemr';
$dbname=isset($sqlconf['dbase'])?$sqlconf['dbase']:'openemr';
//echo '<pre>';print_r($sqlconf);
  
ob_start();

             
        $html = "
        <div class='row' style='justify-content:center;'>
        <h4>Remote Patient Monitoring Consent Form:</h4>
    </div>
    <div class='row' style='margin-top:10px;margin-left:10px;'>
        <p>  I,<b> ".$name."</b> hereby consent to participate in the <b>".$program_name."</b> and agree to the following terms:</p>
    </div> 
    <ol>
        <li>I understand that the purpose of the remote patient monitoring program is to collect and transmit data about my health status to my healthcare provider(s) in order to improve my medical care and treatment. I will do my best to take measurements daily.</li>
        <li>I understand that the program will involve the use of electronic devices to collect and transmit data about my health status, including but not limited to my vital signs, medical history, and medication usage.</li>
        <li>I understand that my healthcare provider(s) will use the data collected through the program to monitor my health, provide medical care, and make treatment decisions.</li>
        <li>I understand that my personal and health-related data will be collected, used, and shared as part of the program. I also understand that my data may be shared with other healthcare providers or organizations for the purpose of improving my medical care.</li>
        <li>I understand that the program may involve some risks, including but not limited to the possibility of data breaches or unauthorized access to my personal and health-related data. I acknowledge that I have been informed of these risks and understand that my healthcare provider(s) will take reasonable steps to protect my data.</li>
        <li>I understand that I have the right to withdraw my consent to participate in the program at any time by contacting my healthcare provider(s). I also understand that my withdrawal of consent will not affect my ability to receive medical care.</li>
        <li>I understand that I have the right to access and review my personal and health-related data that is collected as part of the program, and to request corrections to any errors.</li>
        <li>I am aware that this equipment is specifically assigned to me and should not be used by anyone else. Any measurements taken in this equipment will be used to make decisions to manage my medical condition.</li>
        <li>I am responsible for the misuse or loss of the device. I understand that the value of the device is $80.</li>
        <li>I understand that I can participate in the remote monitoring program with only one provider at any given time</li>

    </ol> <br>
    <p>I have read and understand the information provided above, and I give my informed consent to participate in the <b>".$participate_name."</b></p>
   <p> Date:<b>".$date."</b></p>
   <p>Patient's signature:<br>";

   if(isset($_GET['insert_id'])&&$_GET['insert_id']=='portal'){
   $html.="<img src='../../interface/customized/sign/".$pid.'/'.$file_name."' style='width:20%;height:80px;'>";
   }
   else{
    $html.="<br><img src='".$esign."' style='width:20%;height:80px;'>";
   }
   $html.="</p>";
   if(isset($_GET['insert_id'])&&$_GET['insert_id']=='portal')
   {
        include "DatabaseConnection.php";            
        $pdo = new PDO('mysql:host='.$hostname.';port='.$port.';dbname='.$dbname.'', ''.$username.'', ''.$password.'', array( PDO::ATTR_PERSISTENT => false));
        $signtime=date('Y-m-d H:i:s');
        $doctype= 'Consent Form';
        $document_insert="INSERT INTO onsite_documents(pid,provider,encounter,doc_type,patient_signed_status,patient_signed_time,denial_reason,patient_signature,full_document)VALUES('".$pid."','0','0','".$doctype."','1','".$signtime."','In Review','".$esign."',:pdf_doc)";
        $stmt = $pdo->prepare($document_insert);
        $stmt->bindParam(':pdf_doc',$html,PDO::PARAM_LOB);
        if($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';
        } else {
            
            echo 'Information saved';
        }
        $doc_query=sqlQuery("SELECT id FROM onsite_documents WHERE pid='".$pid."' order by id DESC limit 1");
        $doc_id=isset($doc_query['id'])?$doc_query['id']:1;
        if($doc_id){
            $url1='';
             $id=sqlInsert("INSERT INTO constant_form(pid,name,esign,date,participate_name,url,status,program_name) VALUES(?,?,?,?,?,?,?,?)",array($pid,$name,$esign,$date,$participate_name,$url1,1,$program_name));
             $onsite_portalinsert=sqlInsert("INSERT INTO onsite_portal_activity (date,patient_id,activity,require_audit,pending_action,action_taken,status,narrative,table_action,table_args,action_user,action_taken_time,checksum) VALUES ('".$signtime."', '".$pid."', 'document', '1', 'review', '', 'waiting', '".$doctype."', 'update', '".$doc_id."',  '0','".$signtime."', '0')");
            
        }
           exit(); 

    }
    else
    {
        $site=isset($_SESSION['site_id'])?$_SESSION['site_id']:'';            
        $dir=$GLOBALS['OE_SITES_BASE'].'/'.$site.'/documents/'.$pid.'/';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        //echo $GLOBALS['OE_SITES_BASE'];exit();
        $body = ob_get_contents();
        ob_end_clean();
        $mpdf->setTitle("Patient Constant form");
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        $mpdf->SetHTMLHeader($header);
        $mpdf->WriteHTML($html);
        
        $mpdf->defaultfooterline = 0;
        $pdf= $dir.$pid.'_'.mt_rand(10,100).'consent_form'.'.pdf';
        $mpdf->Output($pdf, 'F');

        $form_id=sqlInsert("INSERT INTO constant_form(pid,name,esign,date,participate_name,url,status,program_name) 
        VALUES(?,?,?,?,?,?,?,?)",array($pid,$name,$esign,$date,$participate_name,$url1,1,$program_name));
         // $document_id = 28;
         //$doc_id=$form_id.$pid.mt_rand(10,100);
         $doc_id = generate_id();   
         $date=date('Y-m-d H:i:s');
        $type= 'file_url';
        $mime_type='application/pdf';
        $doc_name='Consent_form.pdf';
        //$size=949075;
        //$ids=uniqid();
        //$hash='';
        $cat_id=28;
        $documents_cat=sqlInsert("INSERT INTO categories_to_documents(category_id,document_id)
                VALUES($cat_id,$doc_id )");
        $document_insert=sqlInsert("INSERT INTO documents(id,url,type,date,mimetype,owner,name,revision,foreign_id)
        VALUES(?,?,?,?,?,?,?,?,?)",array($doc_id,$pdf,$type,$date,$mime_type,1,$doc_name, $date,$pid));
       exit();
              
    }               
    
      

}
?>
<!DOCTYPE>
<html>
<head>
<title><?php echo xlt("Patient Reports"); ?></title>

 <?php Header::setupHeader(['datetime-picker', 'common']); ?>
 <link rel="stylesheet" href="css/jquery.signature.css"> 
 
<style>
    .textbox{
        border-left: 0;
        border-right: 0;
        border-top: 0;
        outline: none;
    }
    .error_msg{
        color:red;        
    }
    
    </style>
</head>
<body>
    <?php
    //$pid1=$_GET['pid']?$_GET['pid']:'';
    ?>
    <div class="container">
       
        <div class="row" style="justify-content:center;">
            <h4>Remote Patient Monitoring Consent Form:</h4>
        </div>
        <form method="post" name="my_form" id="my_form">
            <input type="hidden" name="insert_id" id="insert_id" value="<?php echo isset($_GET['type'])?'nonportal':'portal';  ?>">
            <input type='hidden' id='pid' value="<?php echo $_GET['pid']?$_GET['pid']:'';?>">
        <div class="row mt-2">
            <p>I, <input type="text" name="patient_name" class="textbox" id="name"> hereby consent to participate in the <input type="text" name="program_name" class="textbox" id="program_name"> and agree to the following terms:</p>
        </div> 
        <ol>
            <li>I understand that the purpose of the remote patient monitoring program is to collect and transmit data about my health status to my healthcare provider(s) in order to improve my medical care and treatment. I will do my best to take measurements daily.</li>
            <li>I understand that the program will involve the use of electronic devices to collect and transmit data about my health status, including but not limited to my vital signs, medical history, and medication usage.</li>
            <li>I understand that my healthcare provider(s) will use the data collected through the program to monitor my health, provide medical care, and make treatment decisions.</li>
            <li>I understand that my personal and health-related data will be collected, used, and shared as part of the program. I also understand that my data may be shared with other healthcare providers or organizations for the purpose of improving my medical care.</li>
            <li>I understand that the program may involve some risks, including but not limited to the possibility of data breaches or unauthorized access to my personal and health-related data. I acknowledge that I have been informed of these risks and understand that my healthcare provider(s) will take reasonable steps to protect my data.</li>
            <li>I understand that I have the right to withdraw my consent to participate in the program at any time by contacting my healthcare provider(s). I also understand that my withdrawal of consent will not affect my ability to receive medical care.</li>
            <li>I understand that I have the right to access and review my personal and health-related data that is collected as part of the program, and to request corrections to any errors.</li>
            <li>I am aware that this equipment is specifically assigned to me and should not be used by anyone else. Any measurements taken in this equipment will be used to make decisions to manage my medical condition.</li>
            <li>I am responsible for the misuse or loss of the device. I understand that the value of the device is $80.</li>
            <li>I understand that I can participate in the remote monitoring program with only one provider at any given time</li>

        </ol> 
        <div class="row">
        <p>I have read and understand the information provided above, and I give my informed consent to participate in the <input type="text" name="participate_name" id="participate_name" class="textbox">[name of remote patient monitoring program].</p>
        </div> 
        <div class="row mt-2">
            <div class="col-12">
            Date:<input type="date" name="date" class="textbox" id="date">
            </div> 
            <div class="col-12 mt-2">
            Patient's signature:<i class="fas fa-pen pen_icon" ></i>
            <input type="hidden" name="esign" id="esign">
            <img src='' class="img" id="img_esign" style="display:none;width:20%;height:80px;" >
            </div>     
        </div> 
        <div class="row" id="error_msg">
        </div>
        <div class="row mt-2" style="justify-content:center;">
            <button type="button" class="btn btn-primary" id="save_form">submit</button>
        </div>  
        </form>         
    </div>
   
<!-- <input type="text" name="name" id="name">
<button type="button" id="save_form"></button> -->

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="sig">
                            <img id="view_img" style="display:none" width='380px' height='144px'>
                        </div>
                        <br />
                        <br />
                        <br />
                        <!-- <button id="clear">Clear</button> -->
                        <textarea id="sign_data" style="display: none"></textarea>
                    </div>
                    <button id="clear" class="btn btn-primary">Clear</button>
                    <input type='button' id="add_sign" class="btn btn-success" data-dismiss="modal" value='Add Sign' style='float:right'>

                </div>
            </div>
        </div>
    </div>
    <!-- modal close -->
</body>
</html>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.signature.min.js"></script>
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

    $("#save_form").on('click',function(){
       
        var name=$("#name").val();
        var esign = $("#esign").val() ;
        var participate_name= $("#participate_name").val();
        var date= $("#date").val();
        var program_name=$("#program_name").val();
        var pid= $("#pid").val();
        var error_count=0;
        var error_msg='';
        if(esign=='' || name=='' || participate_name=='' || date=='' || program_name==''){
            error_msg='Please fill all field';
            error_count++;
        }
      
        if(error_count==0){
            $("#error_msg").html('');
            var value=$("#insert_id").val();
            //$("#my_form").submit();
            $.ajax({
            url:'./constant_form.php?insert_id='+value+'',
            method:'post',
            data:{
                'name':name,
                'date':date,
                'esign':esign,
                'program_name':program_name,
                'pid':pid,
                'participate_name':participate_name
            },
            success:function(data){
                console.log(data);
                var msgSuccess="Form Update SuccessFully";
                signerAlertMsg(msgSuccess, 2000, 'success');
                
                if(value=='portal'){
                   
                   setTimeout( function(){ 
                       dlgclose();
                   }  , 1000 );              
                   
               }
               else{
                window.close();
                
               }
            }
        });
        }
        else{
            signerAlertMsg(error_msg, 2000, 'danger');
          
        }
        
    })
   
    </script>