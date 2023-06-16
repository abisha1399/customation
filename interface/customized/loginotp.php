  <html>
<?php
$name=isset($_GET['name'])?$_GET['name']:'';

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
.btn-custom{
width: 274px !important;
height:40px;
    border-radius: 3px !important;
    /* background-color: #27b388 !important; */
    padding: 0px;
    color: #ffffff !important;
}
input[type=text],input[type=text]:active {
    width: 274px !important;
    height: 40px !important;
    border-radius: 3px !important;
    border: solid 1px #e1e1e1 !important;
    background-color: #ffffff !important;
    box-shadow: none !important;
}
.btn-custom:hover {
  box-shadow:0 0 3px #72e8c4!important;outline:0px;transition:.2s linear all;
    color: #ffffff !important;
    /* border-color: #43c39c!important; */
    /* background-color: #1ace9b !important; */
}

input[type=text]:focus {background:#ffffff!important;border-color:#97b0ce!important;box-shadow:0 0 5px #6698d2cc!important;outline:0px;transition:.2s linear all;}
</style>
<div class="center" align="center">

<div style="margin: 0; margin-top:100px;">
<div class="container">
<div class="page-header">
<h1><small>Enter Verification Code</small></h1>
</div>
</div>
        <div class="well field-container" style="height:300px;width:450px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
	   <?php
      if(isset($_GET["message"]))
     {
	echo $_GET["message"];
       }
          ?>
<form name="forpass" id="forpass" action="loginotpcheck.php?site=<?php echo $_GET['site'] ?>" method="post" class="border-light p-5 justify-content-center" autocomplete=off >
          			<div class="form-group row text-center" >

					<div align="center"><input type="hidden" name="authname" value="<?php echo $name; ?>"><input type="text" class="form-control" placeholder="Enter Verification Code" id="otp" style="width:274px;font-weight:900;" name="otp" maxlength="6" required ></div>
				</div>
				<div align="center"><button type="submit" name="verify" id="verify"   class="btn btn-custom btn-primary"><span class="glyphicon glyphicon-send"></span> Verify</button></div>
	</div>

</form>
</div>
</div>
</div>
</html>
