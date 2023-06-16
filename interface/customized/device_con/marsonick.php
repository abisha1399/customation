<?php

$ignoreAuth = true;
require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
ini_set('display_errors',true);
if(isset($_GET['marsonic_authentication']))
{
    $pid=$_POST['pid'];
    sqlQuery("UPDATE patient_data SET marsonik_status=1 WHERE pid=?",array($pid));
    exit();
}
$pid=isset($_GET['pid'])?$_GET['pid']:'';
$orgname=isset($_SESSION['site_id'])?$_SESSION['site_id']:'';
?>
<html>
    <head>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<button type="button" id ="test" class="btn btn-info btn-sm hidden" data-toggle="modal" data-target="#myModal">marsonic Connect</button>

<!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                          <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Modal Header</h4>
                                  </div>
                                      <div class="modal-body">
                                      <iframe
                                src=""
                                frameborder="0"
                                id="Frame"
                                style="height: 100%; width: 100%"
                                ></iframe>
                                      </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                          </div>
                  
                </div>
      </div>


    <!-- <button id ="test">Click me</button>  -->

</body>

<script>
$(function($)
{
    $('#test').click();
});
//   $.ajax({
//             url:"https://myevolvgccsdev.netsmartcloud.com/api/session/authenticate",    //the page containing php script
//             type: "post",    
//             async:true,
//             crossDomain:true,
//             data: {login_name:"gcapi ", password:"1L0veap1$$"},
//             success:function(result){
//                 console.log(result);
//             }
//         });
// })
    async function getAuthToken(formData) {
            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
            var raw = JSON.stringify(formData);
                var requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: raw,
                redirect: "follow",
                };
                try {
                let response = await fetch(

                "https://0vo2f7s2o2.execute-api.us-east-1.amazonaws.com/default/webhookAuthAPI",

                requestOptions
                );
                let data = {};
                if (response.status == 200) {
                data = await response.json();
                }
                return { jwt: data, status: response.status };
                } catch (err) {
                console.log(err);
                return { jwt: {}, status: 400 };
                }
        };
        const btn = document.getElementById("test");
        var org_name='<?php echo $orgname; ?>';
        var pid='<?php echo $pid ;?>';
        var marsonick_pid=org_name+':'+pid;
btn.onclick = async function () {
let formData = {
username: "support@refresh.com",
password: "Tb6@32G23bvMX%",
clientId: "K5kDVD3PSdaswsDZRi_J8A",
patientId: marsonick_pid,
};
var { jwt, status } = await getAuthToken(formData);
        if (status == 200) {
        let mode = jwt.mode;
        let iframe_src = "";
        jwt = JSON.stringify(jwt); // stringify the JSON
        if (mode == "edit")

        {iframe_src = `https://client.marsonik.com/patient/edit?jwt=${jwt}`;}

        if (mode == "add")

        {iframe_src = `https://client.marsonik.com/patient/add?jwt=${jwt}`;}

        document.getElementById("Frame").src = iframe_src; // update iframe url
      
        }
        }
        
window.addEventListener("message", (event) => {
  
    
// Do we trust the sender of this message?

// if (event.origin !== "https://client.marsonik.com") // if event is not send from https://client.marsonik.com, dont proceed
// return;
// console.log(event, "EVENT");
// console.log("Message body", event.data); // this is the JSON send from Iframe
    let data = event.data
    console.log('alldata',event);

    if("GatewayMacId" in data){
        if(data['ClientId']!='')
        {           
            $.ajax({
                "async": true,
                "crossDomain": true,
                "url": "./marsonick.php?marsonic_authentication=true",
                "method": "POST",
                "data":{
                    pid:pid                    
                },
                success: function(response)
                {
                    $('#myModal').modal('hide') ;// close the modal when close message is sent
                    window.close();
                }  
            }); 
        }
        
    }

    if ("message" in data){
                    
        if (data['message'] == "close")
        {

              $('#myModal').modal('hide') ;// close the modal when close message is sent
              window.close();
        }
                            
                       
    }
});
$(".btn-default,.close").click(function(){
    $('#myModal').modal('hide') ;// close the modal when close message is sent
              window.close();
})
    </script>
    </html>
