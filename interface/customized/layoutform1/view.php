<?php 
require_once("../../globals.php");
require_once("$srcdir/acl.inc");
require_once("$srcdir/log.inc");

?>

<!DOCTYPE html>
<html lang="en-US">
    <head>

        <title>Form Builder</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/tether.min.css"/>
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="css/form_builder.css"/>
<!-- 
        <script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/datatables.net-1-10-13/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="<?php echo $webroot ?>/interface/main/tabs/js/include_opener.js"></script>
<style>

.tooltip-inner {
  background-color: #00acd6 !important;
  /*!important is not necessary if you place custom.css at the end of your css calls. For the purpose of this demo, it seems to be required in SO snippet*/
  color: #fff;
}
</style>
</head>
<body>
<div class="container">
    <div class="row">
<legend class="header">Form List</legend>

    <div class="col-md-3">
    <ul class="list-group">
    
  <div class="row list-group-item d-flex justify-content-between align-items-center" onclick="pageChange(1,'Billing')">
        <div class="col-md-8">Billing</div>
       
  </div>
  <div class="row list-group-item d-flex justify-content-between align-items-center" onclick="pageChange(1,'Clinical Form')">
        <div class="col-md-8">Clinical Forms</div>
        
  </div>
  <div class="row list-group-item d-flex justify-content-between align-items-center" onclick="pageChange(1,'History Form')">
        <div class="col-md-8">History Forms</div>
        
  </div>
</ul>
    </div>
        
        <div class="col-md-5 jumbotron" style="margin-left:1%;">
            <div class="well well-sm viewForm ">
                
                <form class="form-horizontal" method="post">
                    <fieldset class="list-item">
                    
                    <a href="javascript:void(0);" onclick="pageChange(2,'Form List')" class="offset-md-10 col-md-2">close</a>
                        <div class="row">
                       
                        <div class="col-md-6">
                        <div class="form-group">
                            
                            
                                <input id="fname" name="name" type="text" placeholder="First Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">

                        <div class="form-group">
                            
                                <input id="lname" name="name" type="text" placeholder="Last Name" class="form-control">
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                       
                            <div class="form-group">
                            <select class="form-control" id="sel1" data-toggle="tooltip" data-placement="left" data-html="true">
                                <option >option1</option>
                                <option>option2</option>
                                <option>option3</option>
                                <option>option4</option>
                            </select>
                            </div>
                            </div>
                            <div class="col-md-6">

                        <div class="form-group">
                            
                                <input id="lname" name="name" type="text" placeholder="Last Name" class="form-control">
                            </div>
                        </div>
                        
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-md-2" style="margin-left:1%;">
            <ul class="list-group">
                <div class="row list-group-item d-flex justify-content-between align-items-center">
        <div class="col-md-8"><div class="item" draggable="true"><input type="text" class="textbox" id="textbox"></div></div>
        
  </div>
            </ul>
        </div>
    
</div>
</body>
<script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/form_builder.js"></script>
        <script type="text/javascript" src="../../library/dialog.js?v=<?php echo $v_js_includes; ?>"></script>
<script>
    $(".viewForm").hide();
    $(".viewList").show();
    var listgroup = document.querySelectorAll('.item');
    var listitem = document.querySelectorAll('.list-item');
    var dragItem = null;
    dragForm();
    // console.log(listgroup);
    $("#sel1").tooltip({'trigger':'hover', 'title':'option1<br/>option2<br/>option3<br/>option4<br/>'});
    function pageChange(flag,formName)
    {
        $(".viewForm").hide();
        $(".viewList").hide();
        $(".header").text(formName);
        if(flag==1)
        {
            $(".viewForm").show();
        }else if(flag==2)
        {
            $(".viewList").show();
        }
    }

    function dragForm()
    {    
        for(var i=0;i<listgroup.length;i++)
        {
            // console.log(listgroup[i]);
            var item = listgroup[i];
            // console.log(item.addEventListener('dragStart',function(e){}));
            item.addEventListener('dragstart',function(e)
            {
                // alert();
                    // console.log('dragStart',e);
                    dragItem = item;
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 0);
            })
            item.addEventListener('dragend',function(e)
            {
                // alert();
                    console.log('dragend',e);
                    // dragItem = this;
            })
            for(var j=0;j< listitem.length;j++)
            {
                const list = listitem[j];
            }
        }
    }
    

   
</script>
</html>