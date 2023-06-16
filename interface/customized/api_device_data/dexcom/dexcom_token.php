<?php
// 

$ignoreAuth = true;
require_once("../../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
ini_set('display_errors',true);
use OpenEMR\Core\Header;
Header::setupHeader(['common']);
$pid=isset($_COOKIE['dexcompid'])?$_COOKIE['dexcompid']:'';
$provider_id=isset($_COOKIE['provider_id'])?$_COOKIE['provider_id']:'';
$url='https://api.dexcom.com';
$curl = curl_init();
$code=isset($_GET['code'])?$_GET['code']:'';
$client_id='LOx6HfmEtvDulws0573fUVw9bzaim0st';
$client_secret='pTZHVDpbcJtvu4zj';
$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "https") . "://" . $_SERVER['HTTP_HOST'];
$redirect_uri=$http.$GLOBALS['webroot'].'/interface/dexcom_token.php';
$payload = "grant_type=authorization_code&code=".$code."&redirect_uri=".$redirect_uri."&client_id=".$client_id."&client_secret=".$client_secret."";

curl_setopt_array($curl, [
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/x-www-form-urlencoded"
  ],
  CURLOPT_POSTFIELDS => $payload,
  CURLOPT_URL => "".$url."/v2/oauth2/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
]);

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
  
  echo "cURL Error #:" . $error;exit();
}
else {
  
    $result=json_decode($response,TRUE);
    $token=isset($result['access_token'])?$result['access_token']:'';
    $refresh_token=isset($result['refresh_token'])?$result['refresh_token']:'';
    if($token!=''){
      $curl1 = curl_init();
      $payload1 = "grant_type=refresh_token&refresh_token=".$refresh_token."&redirect_uri=".$redirect_uri."&client_id=".$client_id."&client_secret=".$client_secret."";

      curl_setopt_array($curl1, [
        CURLOPT_HTTPHEADER => [
          "Content-Type: application/x-www-form-urlencoded"
        ],
        CURLOPT_POSTFIELDS => $payload1,
        CURLOPT_URL => "".$url."/v2/oauth2/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
      ]);

      $response1 = curl_exec($curl1);
      $error1 = curl_error($curl1);
      curl_close($curl1);

      if ($error1) {
        echo "cURL Error #:" . $error1;die();
      } else {
        $result_array= json_decode($response1,TRUE);
        //echo '<pre>';print_r($result_array);
        $access_token=isset($result_array['access_token'])?$result_array['access_token']:'';
        $date = date('Y-m-d H:i:s');
        //$token_expirity_date = date('Y-m-d',strtotime(date("Y-m-d") . " + 365 day"));
        $token_expirity_date    = date('Y-m-d', strtotime(date("Y-m-d"). ' + 365 days'));
        $status=$access_token?1:0;
        if($access_token!='')
        {
          $type=sqlQuery("SELECT * FROM dexcom_token WHERE pid=".$pid."");
          if(!empty($type))
          {
            sqlStatement("UPDATE dexcom_token SET access_token='".$access_token."',user_id='".$provider_id."',status=1 WHERE pid=".$pid."");
          }                
          else
          {                 
            sqlInsert("INSERT INTO dexcom_token (pid,access_token,token_expirity_date,status,user_id) VALUES(?,?,?,?,?)",array($pid,$access_token,$token_expirity_date,$status,$provider_id));
          }
        }
        else{
          echo 'something went wrong ';
          die();
        }
      

      }

    }
    else{
      echo '<div class="px-3 alert alert-light bg-white white overflow-hidden d-flex align-items-center justify-content-center ripple mb-0"
      id="card" ><b> Something Went Wrong Try again later</b></div>';
      die();
    }

}

?>


<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
      .card-title {
        float:left;
        width:100%;
        color:#000000;
        font-family:Lucida Console;
        letter-spacing:3px;
        font-size:22px;
        text-align:center;
        margin:20px 0px;
        margin-left:0px;
        margin-top:-50px;
      }   
        
      #card{
          border: 1px solid rgb(230 236 232); 
          height: 500px;
          width:400px;
          border-radius: 0.5em; background-color: rgb(251, 251, 251);
          margin-top:20px;
      }
      .div_class{
      display: flex;
      justify-content: center;
    }
    </style>
  </head>
  <body style="background-color: #DBF9FC;">
    <div class="div_class">
      <?php if (($status==1)){ ?> 
        <div class="mb-0"id="card" >  
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" style="color:green;margin-top:150px;margin-left:130px" width="150" height="150" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 24 24">
              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
            </svg>
          </div>
          <br>
          <h5 class="card-title" style=""><b> Your account has been successfully linked to DEXCOM</b> </h5>
      
        </div>
      <?php }
      else{
        echo '<div class="px-3 alert alert-light bg-white white overflow-hidden d-flex align-items-center justify-content-center ripple mb-0"
        id="card" ><b> Something Went Wrong Try again later</b></div>';
      }
      ?>
    </div>
  </body>
</html>
