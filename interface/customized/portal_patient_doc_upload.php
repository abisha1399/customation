<?php 

$ignoreAuth = 1;
require_once("../globals.php");

if(isset($_GET['upload_file']))
{

  $_POST['up_dir']=1;
  $UPLOAD_DIR = '';
  if (!isset($_POST['up_dir'])) {
      $UPLOAD_DIR =  $GLOBALS['OE_SITE_DIR'] . '/documents/onsite_portal_documents/templates/';
  } else {
      if ($_POST['up_dir'] > 0) {
          $UPLOAD_DIR = $GLOBALS['OE_SITE_DIR'] . '/documents/onsite_portal_documents/templates/' . $_POST['up_dir'] . '/';
      } else {
          $UPLOAD_DIR = $GLOBALS['OE_SITE_DIR'] . '/documents/onsite_portal_documents/templates/';
      }
  }
  if (!empty($_FILES["tplFile"])) {
      $tplFile = $_FILES["tplFile"];
  
     
  
      // ensure a safe filename
      $name = preg_replace("/[^A-Z0-9._-]/i", "_", $tplFile["name"]);
     
      if (preg_match("/(.*)\.(php|php3|php4|php5|php7)$/i", $name) !== 0) {
          die(xlt('Executables not allowed'));
      }
      $parts = pathinfo($name);
      $name = $parts["filename"].'-'.$parts['extension'] . ".tpl";
      
      // don't overwrite an existing file
    
      while (file_exists($UPLOAD_DIR . $name)) {
          // $i = rand(0, 128);
          // $newname = $parts["filename"] . "-" . $i . ".tpl"  . ".replaced";
          // rename($UPLOAD_DIR . $name, $UPLOAD_DIR . $newname);
          if(isset($_POST['mobile']))
          {
            echo 0;
          }
          else
          {
            echo "Already File Exits"; 
          }
        
          // chmod($UPLOAD_DIR . $name, 0644);
          exit();
      }
      if(!is_dir($UPLOAD_DIR))
      {
          // echo "if";die;
          mkdir($UPLOAD_DIR,0755,true);
      }
      // echo "44";die;
      // preserve file from temporary directory
      $success = move_uploaded_file($tplFile["tmp_name"], $UPLOAD_DIR . $name);
      if (!$success) {
        if(isset($_POST['mobile']))
        {
          echo 1;
        }
        else
        {
          echo "<p>" . xlt("Unable to save file: Use back button!") . "</p>";
        }
          exit;
      }
      
      // set proper permissions on the new file
     
      chmod($UPLOAD_DIR . $name, 0644);
      if(isset($_POST['mobile']))
      {
        echo 2;
      }
      else
      {
        
        
        require_once("DatabaseConnection.php");
        $hostname=isset($sqlconf['host'])?$sqlconf['host']:'mariadb-c1';
        $port=isset($sqlconf['port'])?$sqlconf['port']:'openemr';
        $username=isset($sqlconf['login'])?$sqlconf['login']:'openemr';
        $password=isset($sqlconf['pass'])?$sqlconf['pass']:'openemr';
        $dbname=isset($sqlconf['dbase'])?$sqlconf['dbase']:'openemr'; 
        $pdo = new PDO('mysql:host='.$hostname.';port='.$port.';dbname='.$dbname.'', ''.$username.'', ''.$password.'', array( PDO::ATTR_PERSISTENT => false));
        echo $pdo;exit();
          $pid=1;      
          $modified_date=date('Y-m-d H:i:s');
          $template_name=  $parts["filename"]; 
          $size=$_FILES['tplFile']['size'];  
          $mime='text/plain';
          $imgData = file_get_contents($_FILES['tplFile']['tmp_name']);
          $imgType = $_FILES['tplFile']['type'];
          $imgData='ssssss';
          
         
          $signtime=date('Y-m-d H:i:s');
          $document_insert="INSERT INTO document_templates (pid,modified_date,template_name,status,send_date, end_date, size, mime,template_content) VALUES ('".$pid."','".$modified_date."','".$template_name."','".$modified_date."','".$modified_date."','".$size."','".$mime."',:pdf_doc)";
          $stmt = $pdo->prepare($document_insert);
          $stmt->bindParam(':pdf_doc',$imgData,PDO::PARAM_LOB);
          if($stmt->execute() === FALSE) {
              echo 'Could not save information to the database';
          } else {
              
              echo 'Information saved';
          }
          
      echo "File Upload Success";
      }
      exit();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Document Upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
    .bg-cap-pry{
  background-color: #367FA9 !important;
  border-color: #367FA9;
}
.bg-white{
  background-color: white !important;
}
.bg-white a{
  background-color: white !important;
}
.bg-white a:hover{
  background-color: #f4f4f4 !important;
}
.body-bg{
  background-color: #E7F3ED !important; 
}
  </style>
</head>
<body class="body-bg">

<nav class="navbar navbar-default bg-white">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Patient Document Upload</a>
    </div>
    <ul class="nav navbar-nav">

      <!-- <li class="active bg-white"><a href="#" onclick='window.location.replace("../../portal/patient/onsitedocuments?pid=<?=$_SESSION["pid"];?>")'>Patient Document</a></li> -->
      <li class="active bg-white"><a href="#" onclick='window.location.replace("../../portal/home.php")'>Return Home</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
<form id="form_upload" class="form"  method="post" enctype="multipart/form-data">
<input class="btn btn-info bg-cap-pry" type="file" name="tplFile" id="tplFile" accept="application/pdf,image/png">
<br>
<input type='hidden' id="up_dir" name="up_dir" value='<?php echo $_SESSION['pid'];?>' />
<input type="hidden" id="dir" name="dir" value=''>
<button class="btn btn-success bg-cap-pry" onclick="save()" type="button" name="upload_submit" id="upload_submit">Upload Docs</button>
</form>
</div>

</body>
<script>

function save()
{
var formData = new FormData();
formData.append('tplFile', $('#tplFile')[0].files[0]);
formData.append('up_dir',$("#up_dir").val());
formData.append('dir',$("#dir").val());

$.ajax({
       url : './portal_patient_doc_upload.php?upload_file',
       type : 'POST',
       data : formData,
       processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
       success : function(data) {
       
               alert(data);
           window.location.reload();
       
       }
});
}
</script>
</html>
