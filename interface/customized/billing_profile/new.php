<?php
/**
 * external_data.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Vinish K <vinish@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once "../../globals.php";
require_once "$srcdir/patient.inc";
require_once "$srcdir/options.inc.php";

use OpenEMR\Core\Header;
use OpenEMR\Menu\PatientMenuRole;
use OpenEMR\OeUI\OemrUI;
if(!empty($_POST['profile_id'])){
   $id=$_POST['profile_id'];
   Sqlstatement("UPDATE billing_profile SET is_deleted=1 WHERE id='".$id."'");
   echo '1';
}
$pid=$_SESSION['pid'];

?>
<html>
   <head>
      <?php Header::setupHeader(['opener']); ?>
      <title><?php echo xlt("billing profile"); ?></title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script><?php require_once "$include_root/patient_file/erx_patient_portal_js.php";
// jQuery for popups for eRx and patient portal
?></script>
      <?php
      $arrOeUiSettings = [
          "heading_title" => xl("billing profile"),
          "include_patient_name" => true,
          "expandable" => false,
          "action" => "", //conceal, reveal, search, reset, link or back
          "action_title" => "",
          "action_href" => "", //only for actions - reset, link or back
          "show_help_icon" => false,
      ];
      $oemr_ui = new OemrUI($arrOeUiSettings);
      ?>
      <style>
         .border-box{
         background: #fff;
         border: 1px solid rgba(0,0,0,.125)!important;
         border-radius: 8px;
         border: none;
         width: 100% !important;
         /* padding: 50px; */
         }
         .ant-avatar{
         box-sizing: border-box;
         margin: 0;
         padding: 0;   
         display: inline-block;
         overflow: hidden;
         color: #fff;
         text-align: center;
         vertical-align: middle;
         background: blue;
         width: 51px;
         height: 50px;
         line-height: 45px;
         font-size: 21px;
         font-weight: 600;
         border-radius: 50%;
         }
         .ant-avatar-string{
         position: absolute;
         left: 50%;
         transform-origin: 0 center;
         }
         .header_string{
         color: #000;
         margin-left:20px;
         }
         .list-group{
         display: flex;
         flex-direction: column;
         padding-left: 0;
         margin-bottom: 0;
         border-radius: 0.25rem;
         }
         .list-group-item{
         padding-left: 1.75rem;
         border: none!important;
         padding-bottom: 0;
         font-size: 14px;
         line-height: 20px;
         font-weight: 500;
         position: relative;
         display: block;
         padding: 0.75rem 1.25rem;
         background-color: #fff;
         }
         .list-group-item:first-child {
         border-top-left-radius: inherit;
         border-top-right-radius: inherit;
         }
         ._text_1 {
         color: #2e2c34;
         font-weight: 500;
         text-align: center;
         float: right;
         }
         .border-box:hover {
            box-shadow: 0 0 11px rgba(33,33,33,.2); 
            }
      </style>
   </head>
   <body>
      <div id="container_div" class="<?php echo $oemr_ui->oeContainer(); ?> mt-3">
         <div class="row">
            <div class="col-sm-12">
               <?php require_once "$include_root/patient_file/summary/dashboard_header.php"; ?>
            </div>
         </div>
         <?php
         $list_id = "billing_profile"; // to indicate nav item is active, count and give correct id
         // Collect the patient menu then build it
         $menuPatient = new PatientMenuRole();
         $menuPatient->displayHorizNavBarMenu();
         ?>
         
            <div class="col-sm-12" style="margin-top:10px;">
               <ul class="nav nav-pills">
                  <li class="nav-item" id="btnEncounters">
                     <button class="btn btn-primary" onclick="view_profile(0);">
                        <?php echo xlt("add new profile"); ?></a>
                  </li>
               </ul>
            </div>
            <div class="col-sm-12 mt-3">
                <div class="row">
                  <?php
                  $billing_profile= Sqlstatement("SELECT * FROM billing_profile where is_deleted=0 AND pid='".$pid."'");
                 
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
                        if($code->codename=='CPT')
                        {
                           $cpt_code_name.=$code->code.',';  
                        }
                        if($code->codename=='HCPCS')
                        {
                           $hcpcs_code_name.=$code->code.',';  
                        }
                        
                     }
                     // if(!empty($codes->ICD10)){
                     // foreach($codes->ICD10 as $value){                        
                     //    $icd10_code_name.=$value->code.',';
                     //    //echo $code_name;
                     // }
                     // }
                     // if(!empty($codes->CPT)){
                     //    foreach($codes->CPT as $value){                        
                     //       $cpt_code_name.=$value->code.',';                           
                     //    }

                     // }
                     // if(!empty($codes->HCPCS)){
                     //    foreach($codes->HCPCS as $value){                        
                     //       $hcpcs_code_name.=$value->code.',';                           
                     //    }

                     // }
                     
                     //echo $code_name;
                    
                  ?>
                    <div class="col-4 mt-3" id="profile_box_<?php echo $row['id']?>">
                        <div class="border-box">
                            <div class="border-header p-2  border-bottom" style="display:flex;align-items: center;">
                              <?php
                              $profile_name=$row['profile_name'];
                              $profile_code=substr($profile_name,0,1);
                              ?>  
                              <span class="ant-avatar">
                                <?php echo $profile_code;?>
                                </span>
                                <div class="header_string">
                                <span><?php echo $profile_name;?></span>
                                </div>   
                            </div> 
              
                            <div class="card-body p-0">
                                <div class="list-group">
                                    <div class="list-group-item" style="color: rgb(99, 109, 115);">
                                        ICD-10
                                        <span class="_text_1">
                                            <span><?php 
                                            $icd10_code_name=rtrim($icd10_code_name,',');
                                            echo $icd10_code_name??'-';?>
                                            </span>
                                        </span>
                                   </div>
                                   <div class="list-group-item" style="color: rgb(99, 109, 115);">
                                       CPT
                                        <span class="_text_1">
                                            <span>-</span>
                                        </span>
                                    </div>
                                    <div class="list-group-item" style="color: rgb(99, 109, 115);">
                                    HCPCS
                                        <span class="_text_1">
                                            <span>-</span>
                                        </span>
                                    </div>
                                    
                                </div>
                            </div> 
                            <!--bottem-->
                            <div class="card-footer" id="card_footer_cont" style="display:flex;margin-top:10px;">
                               <div>
                                 <button class="btn btn-outline-primary" onclick="view_profile(<?php echo $row['id'];?>)">
                                 <span class="fa fa-pencil" ></span> edit 
                                 </button>

                               </div> 
                               <div style="margin-left:10px;">
                               <button class="btn btn-outline-danger" onclick="delete_profile(<?php echo $row['id'];?>)">
                                 <span class="fa fa-trash-o" ></span> delete 
                                 </button>
                               </div> 
                            
                            </div>
                         <!--endbortem-->
                        </div> 
                    </div> 
                  <?php
                  }
                  ?>  
                </div>            
            </div>
      </div>
      <!--end of container div-->
      <?php $oemr_ui->oeBelowContainerDiv(); ?>
   </body>
</html>
<script>
   $(function(){
   // var cookieval = $.cookie('closevalue');
   // if (cookieval === 'true'){
   //    location.reload(true);
   //    $.removeCookie("closevalue");
   // } else {
   //    //here implement another style
   // }
});
   function view_profile(id) {
   top.restoreSession();    
   dlgopen('codes.php?id=' + encodeURIComponent(id),'_blank', 1000, 600);
   }

   function delete_profile(id){
      $("#profile_box_"+id+"").remove();
      $.ajax({
              url: './new.php',
              method: 'POST',
              dataType: "json",
              data: {'profile_id':id},
              success: function(data){
                if(data!='')
                {
                  $("#profile_box_"+id+"").remove();
                }
              }
            });
   }
   
</script>