<?php
/**
 * Clinical instructions form report.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(dirname(__FILE__) . '/../../globals.php');
require_once($GLOBALS["srcdir"] . "/api.inc");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");

    $id= $_GET['id'];
    $data = sqlQuery("select * from form_integrated_summary where id='".$id."'");
    if ($data) 
    {   
        
        if($data['sex']=='male' && $data['sex']!="")
        { 
          $male ='checked="checked"';
        }
        if($data['sex']=='female' && $data['sex']!="")
        { 
          $female ='checked="checked"';
        }
        
        $print = '        
        <table style="width:100%;">
         <tr>
          <td><h5>Integrated Summary '.$data['first_name'].', '.$data['last_name'].'</h5></td>
         </tr>

         <tr>
          <td><br>
            Ms./Mr. is a '.$data['integrated1'];
            if(isset($data['text1'])){
             $print.= $data['text1']; 
           } else{
               
              $print.=' who entered treatment at The Center for Network Therapy for ambulatory withdrawal management for '.$data['integrated2'];}
                 $print.='
          </td>
         </tr>

         <tr>
          <td><br>
          Ms./Mr. '.$data['integrated3'];
          if(isset($data['text2'])){
            $print.= $data['text2']; 
          } else{ $print.='reported that there is no OR a family history of addiction, which indicates that there is no OR a likely  biological predisposition for it. The client presents with ';}$data['integrated4'];
          $print.=' or has no psychiatric diagnosis at this time, and they will be provided with daily psychiatric assessments in an attempt to ensure continued stability. Medically, the client has a history of ';$data['integrated5'];
          if(isset($data['text3'])){
            $print.= $data['text3']; 
          } else{ $print.=' or has no biomedical complications or conditions at this time.';}$print.='
          </td>
         </tr>

         <tr>
          <td><br>
          Ms./Mr. '.$data['integrated6'] ;
          if(isset($data['text4'])){
            $print.= $data['text4']; 
          } else{ $print.='indicated that they have the support of their and family members, which will be beneficial for their recovery. Per the client, their addiction was mostly triggered by ';};$data['integrated7'];
          if(isset($data['text5'])){
            $print.= $data['text5']; 
          } else{ $print.=' and. The client’s low levels OR inconsistencies of trigger recognition and lack of knowledge OR ambivalence regarding relapse prevention strategies are risk factors for continued relapse in the absence of substance abuse treatment. Despite the risk factors, Ms./Mr. ';};
          $data['integrated8'];
          if(isset($data['text6'])){
            $print.= $data['text6']; 
          } else{ $print.=' reportedly has a desire to avoid relapse and live a substance free lifestyle for themselves and for their ';};$data['integrated9'];$print.=' 
          </td>
         </tr>

         <tr>
          <td><br>
          Ms./Mr. '.$data['integrated10'];
          if(isset($data['text7'])){
            $print.= $data['text7']; 
          } else{ $print.=' seems to be in the contemplation stage of change according to their Socrates recognition score (00), they have a ';}$data['integrated11'];if(isset($data['text8'])){
            $print.= $data['text8']; 
          } else{ $print.=' recognition of how their addiction has negatively impacted their life and the harm that continued use will cause. They scored ';}$data['integrated12'];
          if(isset($data['text9'])){
            $print.= $data['text9']; 
          } else{ $print.=' for ambivalence ( ), (high) which indicates that their commitment to change is not consistent OR (low) their commitment to change is consistent. Their score for taking steps was ';}$data['integrated13'];
          if(isset($data['text10'])){
            $print.= $data['text10']; 
          } else{ $print.=' (00), (high) which shows that they have been starting to pursue a lifestyle free from mind altering substances, although unable to achieve long-term sobriety on their own OR (low) which shows that they demonstrate a lack of initiative to alter their lifestyle to achieve long-term sobriety on their own. The Becks Depression Index score of (00 ) indicates that there are ';}$data['integrated14'];if(isset($data['text11'])){
            $print.= $data['text11']; 
          } else{ $print.=' levels of depression at this time and the Beck Anxiety Inventory score of (00) indicates that there are ';}$data['integrated15'];
          if(isset($data['text12'])){
            $print.= $data['text12']; 
          } else{ $print.=' levels of anxiety. The client will be provided with daily psychiatric assessments to address any existing symptoms. According to their Fagerstrom Test for Nicotine score (00), they have ';}$data['integrated16'];
          $print.=' dependence on nicotine. 
          </td>
         </tr>

         <tr>
          <td><br>
          Ms./Mr. '.$data['integrated17'].' reports their strengths as being '.$data['integrated18'].'. Ms./Mr. '.$data['integrated19'].' reports their needs to be '.$data['integrated20'].'. Ms./Mr. '.$data['integrated21'].' identified their abilities as '.$data['integrated22'].'. Ms./Mr. '.$data['integrated23'].' reported their preferences as '.$data['integrated24'].'.
          </td>
         </tr>

         <tr>
          <td><br>';
          if(isset($data['text12'])){
            $print.= $data['text12']; 
          } else{ $print.=
          'At this time, it is recommended that the client fully engage in the individual, group, and psychiatric sessions provided at the Center for Network Therapy to learn relapse prevention methods and coping skills, in conjunction with gaining additional social support.  These factors have potential to assist the client with maintaining a substance free lifestyle. Absent of these therapeutic tools, the client remains at high risk for relapse.';}
          $print.=
          '</td>
         </tr>

         <tr>
          <td><br><br><br>
         <h5>Admission Date: '.$data['integrated_date'].'</h5>
          </td>
         </tr>

        </table>
        ';
    }
    else{
        $print="Not Found";
    }
    //  echo $print;
    //  exit;
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($print);
$file='pdf/'.time().'.pdf';
$mpdf->Output($file,'I');

?>