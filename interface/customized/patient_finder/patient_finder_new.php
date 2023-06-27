<?php

/**
 * dynamic_finder_vitals.php
 *
 * Sponsored by David Eschelbacher, MD
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2012-2016 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(dirname(__FILE__) . "/../../globals.php");
//ini_set('display_errors',true);
require_once "$srcdir/user.inc";
require_once "$srcdir/options.inc.php";

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
use OpenEMR\OeUI\OemrUI;
use OpenEMR\Common\Crypto\CryptoGen;
require '../../customized/PHPMailerAutoload1.php';

$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=== 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
$customized_folder=$http.$GLOBALS['webroot'].'/interface/customized';

?>
<!DOCTYPE html>
<html>
<head>
    <?php Header::setupHeader(['datatables', 'datatables-colreorder', 'datatables-dt', 'datatables-bs']); ?>
   
    <title><?php echo xlt("Patient Finder"); ?></title>
    <style>
        .lilist{
            display: flex;
            align-items: initial;

        }
  #insert_report{
    font-family: 'Manrope';
  }
              .headrow{
    
    background: #6b7cb6;
    justify-content: center;
    font-size: 16px;
    font-weight: 700;
    color: white;
}
.main-row{
    background: #E1E4F0;
    display: flex;
    max-height: 100px;
}
.rowcon{
    box-sizing: border-box;    
    width: 270px;
    height: 105px;    
    background: #FFFFFF;
    border: 1px solid #E9F2FF;
    border-radius: 4px;
    margin: 10px;
   
}
.inner_head{
    width: 268px;
    height: 29px;    
    background: #E1E4F0;
}
.inner_head_span{
    padding-top: 5px;
    font-size: 14px;
    font-weight: 700;
    display:flex;
    
    justify-content: center;
}
.avg_span{
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #30DA88;
    font-weight: 700;
}
.count_span{
    display: flex;
    justify-content: center;
    font-size: 15px;
    color: #646464;
}
.liclass{
    font-size: 15px;
    padding: 4px;
}
.secrowspan{
    width: 174px;
    height: 124px;
    box-sizing: border-box;    
    background: #FFFFFF;
    border: 1px solid #E9F2FF;
    border-radius: 4px;
    margin: 10px
}
.sm_inner_head{
    width: 172px !important;
}
.sm_avg_span{
    color:#FFB323 !important;
}
.img-thumbnail{
            height: 48px;
             border-radius: 50%; 
             /* size:20px; */
             max-width: 50px;
    min-width: 50px;
    width: 50px;
    /* margin-top: -4px;         */

        }
.dateclass{
    font-size:20px;
    font-weight:700;
} 
.dateclass1{
    font-size:16px;
    font-weight:500;
}  
.heading_class{
    font-size:24px;
    font-weight:700;
}

        /* end rport */
        #encounter_show{
            position:fixed!important;
            width:650px;
            height:450px;
            overflow-y: auto;
            right: 5px;
            top: 1px;
            z-index:2000;
            display:none;
            background-color:#fff;
            border:none;
        } 
        .heading {
            text-align: center;
            color: #454343;
            font-size: 30px;
            font-weight: 700;
            position: relative;
            margin-bottom: 70px;
            text-transform: uppercase;
            z-index: 999;
        }
        .white-heading{
            color: #ffffff;
        }
        .heading:after {
            content: ' ';
            position: absolute;
            top: 100%;
            left: 50%;
            height: 40px;
            width: 180px;
            border-radius: 4px;
            transform: translateX(-50%);
            background: url(img/heading-line.png);
            background-repeat: no-repeat;
            background-position: center;
        }
        .white-heading:after {
            background: url(https://i.ibb.co/d7tSD1R/heading-line-white.png);
            background-repeat: no-repeat;
            background-position: center;
        }

        .heading span {
            font-size: 18px;
            display: block;
            font-weight: 500;
        }
        .white-heading span {
            color: #ffffff;
        }
        /*-----Testimonial-------*/

        /* .testimonial:after {
            position: absolute;
            top: -0 !important;
            left: 0;
            content: " ";
            background: url(img/testimonial.bg-top.png);
            background-size: 100% 100px;
            width: 100%;
            height: 100px;
            float: left;
            z-index: 99;
        } */

        .testimonial {
            max-height: 195px;
        }
        .carousel-inner:hover{
        cursor: -moz-grab;
        cursor: -webkit-grab;
        }
        .carousel-inner:active{
        cursor: -moz-grabbing;
        cursor: -webkit-grabbing;
        }
        .carousel-inner .item{
        overflow: hidden;
        }

        .carousel-indicators{
        left: 0;
        margin: 0;
        width: 100%;
        font-size: 0;
        height: 20px;
        bottom: 15px;
        padding: 0 5px;
        cursor: e-resize;
        overflow-x: auto;
        overflow-y: hidden;
        position: absolute;
        text-align: center;
        white-space: nowrap;
        }
        .carousel-indicators li{
        padding: 0;
        width: 14px;
        height: 14px;
        border: none;
        text-indent: 0;
        margin: 2px 3px;
        cursor: pointer;
        display: inline-block;
        background: #ffffff;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        }
        .carousel-indicators .active{
        padding: 0;
        width: 14px;
        height: 14px;
        border: none;
        margin: 2px 3px;
        background-color: #9dd3af;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        }
        .carousel-indicators::-webkit-scrollbar{
        height: 3px;
        }
        .carousel-indicators::-webkit-scrollbar-thumb{
        background: #eeeeee;
        -webkit-border-radius: 0;
        border-radius: 0;
        }

        .carousel-control{
        top: 175px;
        opacity: 1;
        width: 40px;
        bottom: auto;
        height: 40px;
        padding-top: 6px;
        font-size: 10px;
        cursor: pointer;
        font-weight: 700;
        overflow: hidden;
        line-height: 38px;
        text-shadow: none;
        text-align: center;
        position: absolute;
        background: transparent;
        border: 2px solid #ffffff;
        text-transform: uppercase;
        -webkit-border-radius: 100%;
        border-radius: 100%;
        -webkit-box-shadow: none;
        box-shadow: none;
        -webkit-transition: all 0.6s cubic-bezier(0.3,1,0,1);
        transition: all 0.6s cubic-bezier(0.3,1,0,1);
        }
        .carousel-control.left{
        left: 7%;
        top: 50%;
        right: auto;
        padding-top: 6px;
        }
        .carousel-control.right{
        right: 7%;
        top: 50%;
        left: auto;
        padding-top: 6px;
        }
        .carousel-control.left:hover,
        .carousel-control.right:hover{
        color: #000;
        background: #fff;
        border: 2px solid #fff;
        }

        .testimonial .carousel-control-next-icon, .testimonial .carousel-control-prev-icon {
            width: 35px;
            height: 35px;
        }
        section.testimonial.text-center {
            background: white;
            /* box-shadow: 0px 0px 6px 0px #bcb4b4;  */
            height: 35px;
            border:1px solid #CCE2FF;
            border-radius: 6px;
            padding: 0;
        }
        .carousel-control-prev {
            left: 5px;
            padding-top: 6px;
        }.carousel-control-next {
            right: 5px;
            padding-top: 6px;
        }
        .demo-group{
            float:left;
            margin-bottom: 0;
            padding-top: 6px;
        }
        .demographics-div{
            /* min-height: 135px; */
        }

        /* ------testimonial  close-------*/
        .name-heading{
            font-size: 17px !important;
            font-weight: 550;
            height: -550px;
        }

        .name-headings{
            font-size: 18px !important;
            font-weight: 600;
            text-align:left;
            margin-right:100px !important;
            padding-top:200px;
        }
        .col-col {
            display: flex;
            width: 20%;
            min-width: 20%;
            align-items: stretch;
            background: white;
            /* margin:5px 0; */
            padding: 5px 5px;
            /* min-height: 122px; */
            flex-direction: row;
            text-align: left;
            margin-right: 0;
            /* border-right: 1px solid #a6b0d3; */
        }.col-col .text {
            font-size: 21px;
            padding: 5px 0;
            font-weight: 750;
        }span.smbl {
            font-size: 12px;
            color: #000000;
            font-weight: 500;
        }.carousel-item .row {
            margin: 0;
        }.col-col img {
            margin-right: 7px;
            height: 28px;
            width: auto;
        }.col-col:last-child {
            border-right: 0;
        }.carousel i.fa {
            color: black;
            width: 22px;
            height: 22px;
            line-height: 23px;
            border-radius: 50%;
            /* box-shadow: 0px 0px 4px 2px #957f7f; */
        }.carousel-control-next, .carousel-control-prev{
        width:2% !important;
        }.col-col .font-weight-bold.d-inline-block {
            font-weight: 700 !important;
            width: 100%;
            text-align: left;
            font-size:14px;
            color:#000000;
            /* min-height: 40px; */
        }
        .carousel-inner.cls-w {
            width: 100%;
            min-height: 50px;
            /* box-shadow: 0px 0px 6px 0px #bcb4b4 !important; */
            border:1px solid #DFDFDF;
            padding:10px;
            padding-top:0px;
            padding-left:0px;
            padding-right:0px;
            padding-bottom:4px;
            /* margin-top:-29px; */
        }
        .testimonialtest {
            display: flex;
            justify-content: center;
            /* padding-top: 15px; */
            /* min-height:132px; */
        }.text.text1 {
            font-size: 12px;
            padding: 0;
        }.img_val {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            min-height: 44px;
        }.col-col div:first-child {
            width: 100%;
        }
        .patdemos{
            cursor: pointer;
        }
        .patdemo:hover {
            cursor: pointer;
            }

        #display_error{
            font-size: 20px;
            font-weight: 600;
            align-items:center;
            padding-left:600px;

        }
        .pagebutton{
            
            /* padding: 14px; */
            width: 13%;
            color: black;
            font-size: 15px;
            font-weight: 600;
        }
        .pagebutton a{
            text-decoration:none;
        }
        .active-class{
            background:#32b7b7
        }
        .open{
            background:#E9F2FF;
            

            padding:1px;
            display:flex;
            /* display:none; */
        }
        .container-new{
            /* box-shadow: 0px 0px 6px 0px #bcb4b4 !important; */
            border-radius: 10px;
        }
        .img-thumbnail{
            height: 48px;
             border-radius: 50%;              
             max-width: 50px;
            min-width: 50px;
            width: 50px;

        }
        
        .img-thumbnails{
            
            width:30px; 
             border-radius: 50%; 
            float:left 4px;
            size:10px;
        }
        
        .icon{
            color:#3a4b84;
            font-weight: 510;
            font-size: 20px;
        }
        .button-vitals{
        background: #328fc1 !important;
        padding: 0px 30px !important;
        margin-bottom: 2px !important;
        margin-top:1px;
        }
        .imgblock{
            display:none;
        }
        .imgview{
            display:block;
        }
        .ullist{
            text-align: initial;
            font-size: 12px;
        }
        .ring{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }img.imgbibtn {
    width: 50px;
    height: auto;
}
        .fileround{
            background: #28a745;
            margin-left: 15px;
            width: 87%;
            height: 45px;
            display: flex;
            justify-content: center;
            /* margin-top: 6px; */
            align-content: stretch;
            /* flex-wrap: nowrap; */
            /* flex-direction: column; */
            border-radius: 20px
        }
        .colorpick{
            height: 37px;
            
        }
        .colorpicks{
            height: 30px;
            
        }
        .colorpicks_close {
            padding: 6px;
        }
        .fileround i{
            color: white;
            min-width: 23px;
            max-width: 35px;
            display: flex;
            align-items: center;
            margin-left: 13px;
        }
        .reading-time{
            display:flex;
            font-size:10px;
            /* display:none; */
        }
        .open_close {
            padding: 6px;
        }
        .img-class {
            padding-left: 12px;
        }
        /* .carousel-item{
            height: 84px;
        } */

        .carousel-item .col-col.p-0 {
            border-right: 1px solid #CECECE;
        }
        .carousel-item .col-col:nth-child(5) {
            border-right: 0px;
        }
        .bi-button{
            border-radius: 20px;
    background: #E9E9E9;
    border: #E9E9E9;
    color: #000000;
    font-weight: 700;
    height: 35px;
    width: 100%;
    min-width: 125px;
    padding: 5px 5px;
    margin: 5px;
        }
        .start-encounter-btn{
            width: 113px;
            height: 30px;
            background: #57BF7F;
            color: #FFFFFF;
            font-weight: 700;
        }
        .circleBase {
            border-radius: 50%;
            background:green;
            /* behavior: url(PIE.htc); */
            /* remove if you don't care about IE8 */
        }
        .type1{
            width: 37px;
            height: 37px;
            background: #57BF7F;
            /* border: 3px solid red; */
        }
        .type1-close{
            margin-left: 10px;
        }
        .testbutton{
            position: absolute;
    top: -100px;
    right: 0px;
    width: 270px;
    height: 155px;
    background: white;
    margin: 3px;
    z-index: 1000;
    
    /* display: none; */
        }
        .bibutton-main {
    position: relative;
   
    padding-top: 0px;
    padding:0px;
}
/* .imgbibtn:not(:hover) + .testbutton {
  display: none;
} */

/* model div style */
.myModal{
    /* display:none; */
    position: fixed!important;
    top:1px!important; 
    left:18%;
    right:18%;
    z-index: 1000;
    width:64%;
    
}
.myModal::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}
.header{
    background-color:#4F62A3;  
}
.card-title{
    background-color:#E9F2FF;
    font-size:16px!important;
    color:#000000;
    font-weight:500!important;
    
}
.card-body{
    padding:0;
}
.left_graph{
    text-align: center!important;
    display: block;
    padding: 89px;
    margin-left: -49px;
    font-size:20px;
    font-weight:bolder;
}
.right_graph{
    text-align: center!important;
    display: block;
    padding: 89px;
    font-size:20px;
    font-weight:bolder;
}
.label{
    margin-bottom:4px;
}
.close_div .first_sec
{
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.open_div .first_sec
{
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.last_div_action {
    display: flex;
    justify-content: space-around;
    align-items: center;
}.open_div .ring {
    margin-bottom: 20px;
}
/* @media only screen and (min-width:1440px) and (max-width:1800px){
    .bi-button {
    min-width: 140px !important;
}
}
@media only screen and (min-width:1801px) and (max-width:2000px){
    .bi-button {
    min-width: 160px !important;
}
}
@media only screen and (min-width:2001px) and (max-width:2500px){
    .bi-button {
        min-width: 200px !important;
}
} */

@media only screen and (max-width: 1280px) {
    .img-thumbnail {
        height: 44px;
    max-width: 44px;
    min-width: 44px;
    width: 44px;
}
.name-heading {
    font-size: 18px !important;
}
.col-col .text {
    font-size: 18px;
    padding: 4px 0;
}
.img-class {
    padding-left: 5px;
}
.img_val {
    min-height: 44px;
}
.col-col img {
    margin-right: 3px;
    height: 26px;
}
span.smbl {
    font-size: 12px;
}
.bi-button {
    border-radius: 20px;
    height: 32px;
    width: 100%;
    font-size: 10px;
    min-width: 100px;
    padding: 4px 5px;
}
.first_sec span.p-2 {
    padding: 5px !important;
}
.icon {
    font-size: 18px;
}
.type1 {
    width: 33px;
    height: 33px;
}
.type1-close img {
    width: 20px;
    height: 20px;
}
img.imgbibtn {
    width: 48px;
}
}
@media only screen and (max-width: 1024px) {
    .img-thumbnail {
    height: 36px;
    max-width: 38px;
    min-width: 38px;
    width: 38px;
}
.name-heading {
    font-size: 15px !important;
}
.col-col .text {
    font-size: 13px;
    padding: 3px 0;
}
.img-class {
    padding-left: 5px;
}
.img_val {
    min-height: 44px;
}
.col-col img {
    margin-right: 3px;
    height: 26px;
}
span.smbl {
    font-size: 10px;
}
.bi-button {
    border-radius: 15px;
    height: 30px;
    width: 100%;
    font-size: 10px;
    min-width: 80px;
    padding: 2px 3px;
}
.first_sec span.p-2 {
    padding: 2px !important;
}
.icon {
    font-size: 15px;
}
.type1 {
    width: 30px;
    height: 30px;
}
.type1-close img {
    width: 20px;
    height: 20px;
}
img.imgbibtn {
    width: 40px;
}
}
    </style>

<?php
    $arrOeUiSettings = array(
    'heading_title' => xl('Patient Finder'),
    'include_patient_name' => false,
    'expandable' => true,
    'expandable_files' => array('dynamic_finder_xpd'),//all file names need suffix _xpd
    'action' => "search",//conceal, reveal, search, reset, link or back
    'action_title' => "",//only for action link, leave empty for conceal, reveal, search
    'action_href' => "",//only for actions - reset, link or back
    'show_help_icon' => false,
    'help_file_name' => ""
    );
    $oemr_ui = new OemrUI($arrOeUiSettings);
    ?>
   
</head>
<body>
    <?php
    $colcount = 0;
    $header0 = "";
    $header = "";
    $coljson = "";
    $orderjson = "";
    $res = sqlStatement("SELECT option_id, title, toggle_setting_1 FROM list_options WHERE " .
        "list_id = 'ptlistcols' AND activity = 1 ORDER BY seq, title");
    $sort_dir_map = generate_list_map('Sort_Direction');
    while ($row = sqlFetchArray($res)) {
        $colname = $row['option_id'];
        $colorder = $sort_dir_map[$row['toggle_setting_1']]; // Get the title 'asc' or 'desc' using the value
        $title = xl_list_label($row['title']);
        $title1 = ($title == xl('Full Name')) ? xl('Name') : $title;
        $header .= "   <th>";
        $header .= text($title);
        $header .= "</th>\n";
        $header0 .= "   <td ><input type='text' size='20' ";
        $header0 .= "value='' class='form-control search_init' id='".$title1."' placeholder='" . xla("Search by") . " " . $title1 . "'/></td>\n";
        if ($coljson) {
            $coljson .= ", ";
        }
    
        $coljson .= "{\"sName\": \"" . addcslashes($colname, "\t\r\n\"\\") . "\"";
        if ($title1 == xl('Name')) {
            $coljson .= ", \"mRender\": wrapInLink";
        }
        $coljson .= "}";
        if ($orderjson) {
            $orderjson .= ", ";
        }
        $orderjson .= "[\"$colcount\", \"" . addcslashes($colorder, "\t\r\n\"\\") . "\"]";
        ++$colcount;
    }
    //echo $header0;
    ?>
    
    
    <div id="container_div" class="<?php echo attr($oemr_ui->oeContainer()); ?> mt-3">
         <div class="w-100">         
            <div>
               <div class="row ml-2" style="">
               <div class="col-4"  style="display:flex"><h2>Patient Finder </h2> <button style="cursor:pointer;margin-left:10px; background-color: #6b7cb6; color:white; border-radius: 7px;border:none;font-weight:bold;padding:0px 15px;margin-bottom: 5px;"  id="refersh_btn" onclick="refresh()">Refresh &nbsp;<i class="fa fa-refresh" style="color:white;"></i></button></div>
                    <div class="col-3">
                    <?php //if (AclMain::aclCheckCore('patients', 'demo', '', array('write','addonly'))) { ?>
                <!-- <button id="create_patient_btn1" class="btn btn-primary btn-add" onclick="top.restoreSession();top.RTop.location = '<?php echo $web_root ?>/interface/new/new.php'"><?php echo xlt('Add New Patient'); ?></button> -->
            <?php //} ?>
                    </div>
                    <div class="dropdown">
                        <?php 
                            $query=sqlstatement("select * from patient_data") ;
                            $count=sqlNumRows($query);
                            
                            ?>
                         <input type="hidden" class="count" value="<?php echo $count;?>">
                        <select class="dropdown-item">
                            <option value="n">Show Entries</option>                            
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="all">All</option>
                        </select>
                    <!-- <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Show Entries
                    </button> -->
                    <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">1</a>
                        <a class="dropdown-item" href="#">2</a>
                        <a class="dropdown-item" href="#">3</a>
                        <a class="dropdown-item" href="#">25</a>
                        <a class="dropdown-item" href="#">50</a>
                        <a class="dropdown-item" href="#">100</a> 
                        
                        <input type="hidden" class="count" value="<?php echo $count;?>">
                        <a class="dropdown-item" href="#" >All</a>
                    </div> -->
                    </div>
                    <div class="col-3"><input type="text" class="form-control" placeholder="search any in demographic" id="search_init"></div>
                    <!-- <div><button class="btn btn-primary" id="search_btn">Search</button></div> -->
                </div>
                <!-- new disign -->
                <div style="background:#8a929d54;padding: 10px;top: -12px;">
                     <div class="row" style="font-size: 20px;font-weight: 600;">
                        <div class="col-2" style="    text-align: center;">
                            Demographics
                        </div>
                        <div class="col-7" style="    text-align: center;"> 
                        Vitals sign                  
                        </div>   
                        <!-- <div class="col-1">
                            
                        </div> -->
                        <div class="col-3" style="display: flex;    justify-content: space-evenly;">
                        <div class="bidiv">BI</div>
                        <div class="actiondiv" >Actions</div>
                            
                        </div>  
                    </div>
                </div>
                <div id="display_error" class="mt-3"></div> 
                <div class="text-center">
                <div id="patient_preview"  class="mt-3">
                <img width="150px" height="150px"  src="dots1.gif">               
                </div>
                </div>               
                </div>
                </div>
                <div class="row" id="pagination" style="float:right;padding:18px;">
                </div>
               
            </div>
          </div>
        </div>
        <!-- form used to open a new top level window when a patient row is clicked -->
       
    </div> <!--End of Container div-->
     

<!-----report_modal--->


        <!-- Modal -->
        <div class="modal fade" id="report_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">      
        <button type="button" class="close"  onclick="close_modal()" aria-hidden="true">&times;</button>      
        </div>
      <div class="modal-body">
       <div id="insert_report"></div>
      </div>
      <div class="modal-footer" style="justify-content:center;">
      <button type="button" class="btn btn-primary" onclick="close_modal()">Close</button>
      </div>
    </div>
  </div>
</div>
<!----endreport---->
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">Edit message</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      
      </div>
      <div class="modal-body">
      <textarea hidden id="textarea-message"> </textarea>
      <div class="form-outline">
      <input type="hidden" id="patinetid_msg">
      <input type="hidden" id="modal_type">
  <textarea class="form-control" id="textAreaExample1" rows="4">
    
</textarea>
  <label class="form-label" for="textAreaExample"></label>
  
</div>
        <button class="btn btn-reply btn-sm btn-success pull-right" id="mytext" onclick="send_msg()"  >send</button>
        <button  class="btn btn-reply btn-sm btn-danger "  onclick="ClearFields();">clear</button> 
       
    </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--Message  Modal -->
<iframe src="" id="encounter_show" ></iframe> 
<form method="post" id="make_pdf" action="../reports/create_pdf.php">
    <input type="hidden" name="hidden_html" id="hidden_html" />
    <input type="hidden" name="from_date" id="pdf_from_date" />
    <input type="hidden" name="pid" id="pid" />
    <input type="hidden" name="to_date" id="pdf_to_date" />
    <input type="hidden" name="date_type" id="select_date" />
    <input type="hidden" name="img_val" id="img_val" />
  
    
   </form>   
</body>
</html>
<script>
var customized_folder='<?php echo $customized_folder;?>';
  //reports
  function report_modal(pid)
  
    {

        $.ajax({
            url:"./patient_finder_ajax.php?get_data",    //the page containing php script
            type: "post",    
            async:true,
            crossDomain:true,
            data: {pid:pid},
            success:function(result){
                console.log(result);               
  
                $("#insert_report").html(result);
                reportchat(pid);
            }
        });
        $("#report_modal").modal('show');
    }

    function reportchat(pid){
        
        $.ajax({
        
        
        url:'./patient_finder_ajax.php?report_graph',
        type: "post",    
        async:true,
        crossDomain:true,
        data: {pid:pid},
        success:function (response){
            // console.log(response);
            var left_count=0;
            var right_count=0;            
            var left_chart=JSON.parse(response);       
            
            left_chart_array=[];                  
            temp_array=[];
            
            for(i=0;i<left_chart.length;i++){
                if(left_chart[i][1]>0 || left_chart[i][2]>0 || left_chart[i][3]>0){
                left_count=1;
                }
                //let label=left_chart[i][0]+' BP:'+left_chart[i][2]+'/'+left_chart[i][3];
                left_chart_array.push([left_chart[i][0],left_chart[i][1],left_chart[i][2],left_chart[i][3]]);
            }
            
            if(left_count==1){
            google.charts.setOnLoadCallback(drawreportChart(pid,left_chart_array,temp_array));
            }
            else{
                $('#left_chart_report').html("<span class='left_graph'>No Data Found</span>");
            }
            
        }
        });
    }



    function drawreportChart(pid,left_chart_array)
     {
        var data = new google.visualization.DataTable();
        

    
        data.addColumn("string","Date");
        data.addColumn("number","Pulse");
        
        data.addColumn("number","systolic");
        data.addColumn('number', 'diastolic');
       
        //data.addColumn({ type: "string", role: "tooltip"});
        data.addRows(left_chart_array);
        var options = {
          curveType: 'function',
          hAxis: { minValue: 0, maxValue: 9 },
          pointSize: 5,
          tooltip: {isHtml: true},
          legend: { position: 'bottom'}
        };

        var chart = new google.visualization.LineChart(document.querySelector('#left_chart_report'));

        chart.draw(data, options);
    }

   function download_report(pid)
   {
        $('#left_chart_report table').html(' ');
        var chart_val=$('#left_chart_report svg').html();
        //console.log(chart_val);
        var img_val=$('#image_src').html();
        //console.log(img_val);
        var date_type='first_week';    
        chart_val=btoa(chart_val); 
        $('#hidden_html').val(chart_val); 
        $("#pid").val(pid);        
        $("#select_date").val(date_type); 
        $("#img_val").val(img_val);  
        $('#make_pdf').submit();   
    }

function close_modal(){
    $('#report_modal').modal('hide');
    $(".modal-backdrop").css("display","none");
}
function printbutton() {
    
    var printContents = document.getElementById('insert_report').innerHTML;    
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();

    document.body.innerHTML = originalContents;
    $('#report_modal').modal('toggle');
}
       
    function send_msg(){
        var message_type = $('#modal_type').val();
        //alert(message_type);
        if(message_type=='sms'){
        
            message_send();
        }
        if(message_type=='mail'){
            email_send();
        }
   
    } 
    sessionStorage.removeItem("altsession");
    function closeEncounterFinderIFrame(){
        $('iframe#encounter_show').hide();
    }       
    function demopat(newpid){
        //alert(newpid); 
        top.restoreSession();
            top.RTop.location = "../../patient_file/summary/demographics.php?set_pid=" + encodeURIComponent(newpid);  
    }
    function start_encounter(pid){ 
        
        var encounter_show = document.getElementById("encounter_show");
        encounter_show.contentWindow.location.replace('../../forms/newpatient/new.php?finder_add=1&pid='+pid);
            if (encounter_show.style.display === "none") {
                 encounter_show.style.display = "block";
           } else {
            encounter_show.style.display = "none";
          }
    }
    // $(document).mouseup(function(e){
    //         var container = $("#encounter_show");
        
    //         // If the target of the click isn't the container
    //         if(!container.is(e.target) && container.has(e.target).length === 0){
    //             alert('do');
    //             container.hide();

    //         }
    // });
  
    function rpm_encounter(pid)
    {
        
        window.sessionStorage.setItem("altsession", "yes");
        window.sessionStorage.setItem("pid", pid);
    }
    $(function(){
        
        show_patient_detail(0);         
    });
    

    $("#search_init").keyup(function(){
        show_patient_detail(0);      

    }); 

    $('.dropdown-item').change(function(){
        var limit=$(this).val();
    if(limit=='all'){
        limit=$(".count").val();
    }
    if(limit=='n'){
        limit=25;
    }
    
        show_patient_detail(0, limit);
    });

    $("#rpm_form").on("mousemove",()=>{
            this.addEventListener("keyup", function(event) {
                if(event.key=='F2'){
                $("#rpm_form").css({
                    "width":"100%",
                    "height":"100%"
                });
            }
            if(event.key=='Tab'){
                $("#rpm_form").css({
                    "width":"650px"
                });
            }
            },
            );

           });         

           $(".note-icon-video").on("click",()=>{
            setInterval(() => {
                //console.log();
                $(".modal-backdrop").css("display","none");
            }, 100);

            });

            $(".note-icon-picture").on("click",()=>{
            setInterval(() => {
            //console.log();
            $(".modal-backdrop").css("display","none");
            }, 100);

            });


    function show_patient_detail(page,limit=''){
        var value=$("#search_init").val();
        if(limit==''){
            limit=$('.dropdown-item').val();
            if(limit=='all'){
                limit=$(".count").val();
            }
            if(limit=='n'){
                limit=25;
            }
        }
        
        //alert(limit);
        $.ajax
        ({
            url:'./patient_finder_ajax.php?patient_detail=true&page='+page+'&limit='+limit+'',
            method:'POST',
            data:{
                value:value
            } ,           
            beforeSend: function() {
               
                $("#patient_preview").show();
                $("#pagination").html(' ');
            },
            success:function(response)
            { 
                var data1=JSON.parse(response);
                if(data1.status=='success')
                {
                    $("#display_error").html("");
                    $("#patient_preview").html(""); 
                    $("#patient_preview").html(data1.p1); 
                    $("#pagination").html('');
                    $('.vitalsdiv').removeClass(' col-6'); 
                    $('.vitalsdiv').addClass('col-8');
                    $('.bisection').removeClass('col-4'); 
                    $('.bisection').addClass('col-2');
                    $('.open').hide();
                    $('.bi-button').hide();
                    $('.start-encounter-btn').hide();
                    $('.reading-time').hide();
                    $('.patdetail').hide();
                    // $('.testimonial').css('height','105px');
                    //$('.testimonial').css('height','59px');
                    //  $('.ring').removeClass('mt-2'); 
                    //$('.ring').addClass('mt-2'); 
                    $('.type1').addClass('type1-close');
                    $('.fa-phone').css('margin-left','0px');
                    //$('.float-left').removeClass('mt-3');
                    $('.demo-group').addClass('mt-1'); 
                    $('.imgblock').css('display','block');   
                    $('.fa-angle-down').css('display','block'); 
                    $('.fa-angle-up  ').css('display','none'); 
                    $(".report_btn").hide();
                    $("#pagination").html(data1.pagination);

                }
                else{
                    $("#patient_preview").html('');
                    $("#display_error").html("No matching records found");
                }
                
            }
        });              
        
    }
    function collapse(pid,action)
    {
        if(action=='hide'){
            $("#collapse_value_"+pid+"").val('hide');
            $('#demodiv_'+pid).removeClass('open_div');
            $('#demodiv_'+pid).addClass('close_div');
            $('#demodiv_'+pid+' .vitalsdiv').removeClass(' col-6'); 
            $('#demodiv_'+pid+' .vitalsdiv').addClass('col-8');
            $('#demodiv_'+pid+' .bisection').removeClass('col-4'); 
            $('#demodiv_'+pid+' .bisection').addClass('col-2');
            $('#demodiv_'+pid+' .open').hide();
            //$('#demodiv_'+pid+' .slide').css('margin-top','-8px');
            $('#demodiv_'+pid+' .bi-button').hide();
            $('#demodiv_'+pid+' .start-encounter-btn').hide();
            $('#demodiv_'+pid+' .reading-time').hide();
            $('#demodiv_'+pid+' .patdetail').hide();
            $('#demodiv_'+pid+' .container-new').removeClass('mt-2'); 
            //$('#demodiv_'+pid+' .container-new').addClass('mt-3');
            
            // $('.testimonial').css('height','105px');
             //$('#demodiv_'+pid+'').css('height','59px');
            //  $('.ring').removeClass('mt-2'); 
             //$('#demodiv_'+pid+' .ring').addClass('mt-2'); 
             $('#demodiv_'+pid+' .type1').addClass('type1-close');
             $('#demodiv_'+pid+' .fa-phone').css('margin-left','0px');
             //$('#demodiv_'+pid+' .float-left').removeClass('mt-3');
             $('#demodiv_'+pid+' .demo-group').addClass('mt-2'); 
             $('#demodiv_'+pid+' .imgblock').css('display','block');   
             $('#demodiv_'+pid+' .fa-angle-down').css('display','block'); 
             $('#demodiv_'+pid+' .fa-angle-up  ').css('display','none'); 
             $('#demodiv_'+pid+' .circleBase').show();
             $('#demodiv_'+pid+' .bibutton-main').show();
             $('#demodiv_'+pid+' .no-vitals').css('margin-top','9px');
             //$('#demodiv_'+pid+' .float-left').removeClass('mt-3');
             $('#demodiv_'+pid+' .colorpicks').hide();
             //$('#demodiv_'+pid+' .action_div').css('margin-left','-3px');
             $('#demodiv_'+pid+' .no-vitals').css('margin-top','-1px');
             $('#demodiv_'+pid+' .patdemodiv').css('margin-top','0px'); 
             $('#demodiv_'+pid+' .report_btn').hide(); 
                   
  
            
        }
        else{
            $("#collapse_value_"+pid+"").val('show');
            $('#demodiv_'+pid+' .report_btn').show(); 
            $('#demodiv_'+pid).addClass('open_div');
            $('#demodiv_'+pid).removeClass('close_div');
            $('#demodiv_'+pid+' .container-new').removeClass('mt-3'); 
            $('#demodiv_'+pid+' .container-new').addClass('mt-0');

            $('#demodiv_'+pid+' .vitalsdiv').removeClass('col-8'); 
            $('#demodiv_'+pid+' .vitalsdiv').addClass('col-6');
            $('#demodiv_'+pid+' .bisection').removeClass('col-2'); 
            $('#demodiv_'+pid+' .bisection').addClass('col-4');
            $('#demodiv_'+pid+' .open').show();
            $('#demodiv_'+pid+' .bi-button').show();
            $('#demodiv_'+pid+' .start-encounter-btn').show();
            $('#demodiv_'+pid+' .reading-time').show();
            $('#demodiv_'+pid+' .patdetail').show();
            $('#demodiv_'+pid+'').css('height','100%');
            
            
             $('#demodiv_'+pid+' .type1').removeClass('type1-close');
             //$('#demodiv_'+pid+' .fa-phone').css('margin-left','12px');
             //$('#demodiv_'+pid+' .float-left').addClass('mt-3');
             $('#demodiv_'+pid+' .demo-group').removeClass('mt-2'); 
             $('#demodiv_'+pid+' .imgblock').css('display','none');   
             $('#demodiv_'+pid+' .fa-angle-down').css('display','none'); 
             $('#demodiv_'+pid+' .fa-angle-up').css('display','block');
             $('#demodiv_'+pid+' .circleBase').hide();  
             $('#demodiv_'+pid+' .bibutton-main').hide(); 
             //$('#demodiv_'+pid+' .no-vitals').css('margin-top','25px');
             $('#demodiv_'+pid+' .colorpicks').show(); 
             //$('#demodiv_'+pid+' .action_div').css('margin-left','-43px');
             //$('#demodiv_'+pid+' .no-vitals').css('margin-left','35px');
             //$('#demodiv_'+pid+' .patdemodiv').css('margin-top','-18px');
             
             
        }
    }

    function email_send(){
       // alert(pid);
       var pid=$("#patinetid_msg").val();
       var message = $("#textAreaExample1").val();  
        message = message.replace(/\r?\n/g, '<br />');
                  if(message== ''){
                  //  alert("Message should be not empty");
                  signerAlertMsg("message should not empty", 2000, 'danger');
                    return false;
                  }
                  else{
                    $.ajax
        ({
            url:'./patient_finder_ajax.php?email_send=true',
            method:'POST',
            data:{
                pid:pid,
                message:message
            } ,  
            success:function(response)
            {
                var data1=JSON.parse(response);
                if(data1['status']=='success'){
                    //alert('succes');
                    $("#myModal").modal('hide')
                    signerAlertMsg(data1['msg'], 2000, 'success');
                }
                else{
                    signerAlertMsg(data1['msg'], 2000, 'danger');
                }  
            }
        });
                  }

    }
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
    function dialpad_open(phone){
        dlgopen('../ringcentral/dial_pad.php?phone='+phone+'','_blank', 350, 600);
    }

    function sms_send(pid){
        //alert('hi');
        $("#modal_type").val('sms');
        $.ajax
        ({
            method:'POST',
            url:'./patient_finder_ajax.php?sms_message=true',
            data:{pid:pid},
            success:function(response)
            {
                var str=response;
                str=$.trim(str);
                $("#textAreaExample1").val(str); 
                $("#patinetid_msg").val(pid); 
            }
        });
    }

    
    function message_send()
    {
       var pid=$("#patinetid_msg").val();
       var message = $("#textAreaExample1").val();  
       message = message.replace(/\r?\n/g, '<br>');
        if(message== ''){
            signerAlertMsg("message should not empty", 2000, 'danger');
            return false;
        }
        else{                           
            $.ajax({
                method:'POST',
                url:'../ringcentral/sms_send.php?pid='+pid+'',
                
                data:{
                    pid:pid,
                    message:message
                },
                success:function(response)
                {
                    var str=response;
                    str=$.trim(str);
                    if(str== 1){
                        $("#myModal").modal('hide')
                        signerAlertMsg('message send successfully', 1000, 'success');
                    }
                    else{
                            if(str=='nodata'){
                                signerAlertMsg("Patient does not have number", 1000, 'danger');
                            }
                            else{
                                signerAlertMsg("somethings went wrong", 1000, 'danger');
                            }
                        
                    }
                }
            });
        }
    }
    
</script> 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
 var graph_id =0;
 google.charts.load('current', {'packages':['corechart']});

$(document).mouseup(function (e) {
            if ($(e.target).closest(".testimonialtest").length
                        === 0) {
                            $('.myModal').hide();
            }
        });

        
    function display_modal(pid){
        // console.log(pid);
        $('#myModal'+pid).show();
        $.ajax({
          method:'POST',
          url:'./patient_finder_ajax.php?graph',
          data:{graph_id:pid},
          success:function (response){
            // console.log(response);
            var left_count=0;
            var right_count=0;
            var json_data= response.split('#');
            var left_chart=JSON.parse(json_data[0]);
           
            // console.log(left_chart);
            var right_chart=JSON.parse(json_data[1]);
            left_chart_array=[];
            right_chart_array=[['Date','High','Low']] ;       
            temp_array=[];
            
            for(i=0;i<left_chart.length;i++){
               if(left_chart[i][1]>0 || left_chart[i][2]>0 || left_chart[i][3]>0){
                left_count=1;
               }
                let label=left_chart[i][0]+' BP:'+left_chart[i][2]+'/'+left_chart[i][3];
                left_chart_array.push([left_chart[i][0],left_chart[i][1],left_chart[i][2],label]);
            }

            for(i=0;i<right_chart.length;i++){
                if(right_chart[i][1]>0 || right_chart[i][2]>0){
                right_count=1;
                }
            right_chart_array.push(right_chart[i]);
            }
            if(left_count==1){
            google.charts.setOnLoadCallback(drawChart(pid,left_chart_array,temp_array));
            }
            else{
                $('#left_chart_'+pid).html("<span class='left_graph'>No Data Found</span>");
            }
            if(right_count==1){
            google.charts.setOnLoadCallback(drawChart1(pid,right_chart_array,temp_array));
            }
            else{
                $('#right_chart_'+pid).html("<span class='right_graph'>No Data Found</span>");
            }
        }
        });


    


      function drawChart(pid,left_chart_array) {
        var data = new google.visualization.DataTable();
    
        data.addColumn("string","Date");
        data.addColumn("number","Pulse");
        data.addColumn("number","BP");
        data.addColumn({ type: "string", role: "tooltip"});
        data.addRows(left_chart_array);
        var options = {
          curveType: 'function',
          hAxis: { minValue: 0, maxValue: 9 },
          pointSize: 5,
          tooltip: {isHtml: true},
          legend: { position: 'bottom'}
        };

        var chart = new google.visualization.LineChart(document.querySelector('#left_chart_'+pid));

        chart.draw(data, options);
      }

      function drawChart1(pid,right_chart_array) {
        var data = google.visualization.arrayToDataTable(
       
            right_chart_array
            
         );

        var options = {
          colors:['red','blue'],  
          curveType: 'function',
          hAxis: { minValue: 0, maxValue: 9 },
          pointSize: 5,
          tooltip: {isHtml: true},
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.querySelector('#right_chart_'+pid));

        chart.draw(data, options);
      }

      $('#myModal'+pid).on('mouseleave',()=>{
       $('.myModal').hide();
       
    });
    }

    function ClearFields() {

document.getElementById("textAreaExample1").value = "";

}

function send_mail(pid){
    $("#modal_type").val('mail');
$.ajax({
          method:'POST',
          url:'./patient_finder_ajax.php?message=true',
          data:{pid:pid},
          success:function(response)
            {
                var str=response;
                str=$.trim(str);
             $("#textAreaExample1").val(str); 
             $("#patinetid_msg").val(pid); 
            }
});
}

function function_name(pid){
   //alert(pid);
    $("#mouse_hover_"+pid+"").css("display", "block");
    $("#mouse_hover_"+pid+"").mouseout(function() {
    $("#mouse_hover_"+pid+"").hide();

});
 
}

function ringcentral_video(pid){

$.ajax({
    method:'POST',
    url:'./patient_finder_ajax.php?video=true',
    data:{pid:pid},
    
        beforeSend: function() {
            $("#"+pid+'_video_icon').css('pointer-events','none');
            
        },
    
    success:function(response)
        {
            var str=JSON.parse(response);
            if(str.status=="success"){
                signerAlertMsg('Meeting url sent to patient', 2000, 'success');
                window.open('https://v.ringcentral.com/download/'+str.url, '_blank');
                $("#"+pid+'_video_icon').css('pointer-events','auto');
            
            }
            else if(str.email==""){
                signerAlertMsg("patient don't have email", 2000, 'danger');
            }
            else{
                signerAlertMsg("somethings went wrong", 2000, 'danger');
            }
        }
});
}

function refresh(){
    location.reload(true)
    // var pid='';    
    // if($(".check_vitals").prop('checked') == true){
    //     pid=$('.check_vitals:checked').val();
    // }    
    // if(pid!=''){        
    //     get_vitals_data(pid);
    // }
    // else{        
    //     location.reload(true)
    // }
    
}

function refresh_patient(pid)
{
    $("#vitalsdiv_"+pid+"").html('<div class="spinner-border spinner-border-sm" role="status"></div>');
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": "../../smart_meter_device/iglucose_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {         
        
        }
    });
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": "../../body_trace_api/get_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    });
    
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": "../../get_dexcom_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    }); 
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": "../../omron/get_omron_data.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    });
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": "../../forms/vitals/tryterra/getdata.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        { 
            
        }
    });
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": "../../tide_pool/tide_pool.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {            
               
        }
    });   
    $.ajax
    ({
        "async": true,
        "crossDomain": true,
        "url": "../../forms/vitals/blood_glucose/getdata.php?pid="+pid+"",
        "method": "GET",
        success: function(response) 
        {   
            show_single_patient(pid);
        }
    });
}

function check_vitals(pid){
    
    if($("#check_vitals_"+pid+"").prop('checked') == true){
        $(".check_vitals").prop('checked',false); 
        $("#check_vitals_"+pid+"").prop('checked',true);
    }
        
    
}
function show_single_patient(pid){
    var action=$("#collapse_value_"+pid+"").val();
    $.ajax
        ({
            url:'./patient_finder_ajax.php?single_patient_detail=true',
            method:'POST',
            data:{
                pid:pid
            } ,           
            
            success:function(response)
            { 
                var data1=JSON.parse(response);
                if(data1.status=='success')
                {
                    $("#vitalsdiv_"+pid+"").html(data1.vitals_data);
                    collapse(pid,action);
                    $("#card_data_"+pid+"").html(data1.card_data);
                }
                
                
            }
        });

}

</script> 
<script src="../js/ajax_vitals_api.js"></script>

