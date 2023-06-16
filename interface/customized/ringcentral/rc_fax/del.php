<?php
if(isset($_GET['action']))
{
    
if($_GET['action']=="unlink")
{
    
    unlink($_POST['dfile']);
    echo "success";
}
}
?>