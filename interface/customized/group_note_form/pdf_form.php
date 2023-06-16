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
$data = sqlQuery("select * from form_group_note where id='".$id."'");
if ($data)
{

  if($data['code1']=='1' && $data['code1']!="")
  {
    $code1 ='checked="checked"';
  }
  if($data['code2']=='2' && $data['code2']!="")
  {
    $code2 ='checked="checked"';
  }
  if($data['code3']=='3' && $data['code3']!="")
  {
    $code3 ='checked="checked"';
  }
  if($data['code4']=='4' && $data['code4']!="")
  {
    $code4 ='checked="checked"';
  }
  if($data['code5']=='5' && $data['code5']!="")
  {
    $code5 ='checked="checked"';
  }
  if($data['code6']=='6' && $data['code6']!="")
  {
    $code6 ='checked="checked"';
  }
  if($data['code7']=='7' && $data['code7']!="")
  {
    $code7 ='checked="checked"';
  }
  if($data['code8']=='8' && $data['code8']!="")
  {
    $code8 ='checked="checked"';
  }
  if($data['code9']=='9' && $data['code9']!="")
  {
    $code9 ='checked="checked"';
  }

  if($data['dimension1']=='1' && $data['dimension1']!="")
  {
    $dimension1 ='checked="checked"';
  }
  if($data['dimension2']=='2' && $data['dimension2']!="")
  {
    $dimension2 ='checked="checked"';
  }
  if($data['dimension3']=='3' && $data['dimension3']!="")
  {
    $dimension3 ='checked="checked"';
  }
  if($data['dimension4']=='4' && $data['dimension4']!="")
  {
    $dimension4 ='checked="checked"';
  }
  if($data['dimension5']=='5' && $data['dimension5']!="")
  {
    $dimension5 ='checked="checked"';
  }
  if($data['dimension6']=='6' && $data['dimension6']!="")
  {
    $dimension6 ='checked="checked"';
  }

    $print = '
    <table style="width:100%;">
      <tr>
        <td style="font-style:italic; text-align:center">
          <h6>Center for Network Therapy</h6>
        </td>
      </tr>
      <tr>
          <td style="text-align:center">
            <h6>81 Northfield Avenue, West Orange, NJ 07052 (973) 731-1375</h6>
          </td>
      </tr>
      <tr>
          <td style="text-align:center">
            <h6>GROUP NOTE</h6>
          </td>
      </tr>
    </table>

    <table style="width:100%; border:1px solid black">
      <tr>
        <td style="width:40%; border:1px solid black">Patient Name: '.$data['pat_name'].'</td>
        <td style="width:20%; border:1px solid black">Date: '.$data['date3'].'</td>
        <td style="width:40%; border:1px solid black">Code & Duration:  '.$data['code_dura'].'</td>
      </tr>
    </table>
    <table style="width:100%; border:1px solid black">
      <tr>
        <td style="border:1px solid black">PROBLEM STATEMENT ADDRESSED IN TREATMENT PLAN: “XX.” </td>
      </tr>
    </table>
    <table style="width:100%; border:1px solid black">
      <tr>
        <td style="border:1px solid black">CODES:  <input type="checkbox" name="code1" value="" '.$code1.'>OV-Office &nbsp; <input type="checkbox" name="code2" value="" '.$code2.'>V-Field Visit &nbsp; <input type="checkbox" name="code3" value="" '.$code3.'>G-Group  &nbsp;  <input type="checkbox" name="code4" value="" '.$code4.'>F-Family  &nbsp;  <input type="checkbox" name="code5" value=""'.$code5.'>PE-Psych Eval &nbsp; <input type="checkbox" name="code6" value="" '.$code6.'>L-Letter &nbsp; <input type="checkbox" name="code7" value="" '.$code7.'>TC-Phone Call &nbsp; <input type="checkbox" name="code8" value=""' .$code8.'>C-Cancelled Appt &nbsp; <input type="checkbox" name="code9" value="" '.$code9.'>FA-Failed Appt</td>
      </tr>
    </table>
    <table style="width:100%; border:1px solid black">
      <tr>
        <td style="border:1px solid black">TIME: &emsp; .25 = 15 Minutes  &emsp;  .5 = 30 Minutes  &emsp; .75 = 45 Minutes &emsp;  1.00 = 1 Hour &emsp; 4.5 = 4 Hours, 30 Minutes</td>
      </tr>
    </table>
    <table style="width:100%; border:1px solid black">
      <tr>
        <td style="text-align:center">ASAM DIMENSION(S)</td>
      </tr>
      <tr>
        <td style="text-align:center">Please choose the dimension(s) that this note addresses</td>
      </tr>
      <tr>
        <td style="font-size:12px">Dimension 1 <input type="checkbox" name="dimension1" value="" '.$dimension1.'> &emsp; Dimension 2 <input type="checkbox" name="dimension2" value="" '.$dimension2.'> &emsp;  Dimension 3 <input type="checkbox" name="dimension3" value="" '.$dimension3.'> &emsp;  Dimension 4 <input type="checkbox" name="dimension4" value="" '.$dimension4.'> &emsp;  Dimension 5 <input type="checkbox" name="dimension5" value="" '.$dimension5.'>  &emsp; Dimension 6 <input type="checkbox" name="dimension6" value="" '.$dimension6.'></td>
      </tr>
    </table>
    <table style="width:100%; border:1px solid black">
      <tr>
        <td style="text-align:center">DAP FORMAT</td>
      </tr>
    </table>
    <table style="width:100%; border:1px solid black">
      <tr>
        <td  style="width:50%;font-size:12px;vertical-align:unset;"><p>DATA: Patient statements that capture the theme of the session.  Brief statements as quoted by the patient may be used, as well as paraphrased summaries.</p>

          <p>Observable data or information supporting the subjective statement.  This may include the physical appearance of the patient (e.g., sweaty, shaky, comfortable, disheveled, well-groomed, well-nourished), vital signs, results of completed lab/diagnostics tests, and medications the patient is currently taking or being prescribed.</p>
          <p style="width:100%">'.$data['text_area1'].'</p>
        </td>
        <td style="width:50%;font-size:12px">
          <p>D: “Group Topic: Relapse Prevention” The group involved a review of the benefits of using cognitive behavioral strategies and relapse prevention for each day and a discussion regarding healthier ways to cope with triggers and emotions. Client stated “xx”. Client appeared (ie. euthymic); affect congruent with mood. No SI/HI/AH/VH.</p>

          <p> Next, clients participated in the mutual aid group. The counselor introduced the topic Client appeared euthymic; affect was congruent with mood. (No) current SI/HI/AH/VH.</p>

          <p> Next, the group participated in Cognitive Behavior Therapy. The counselor introduced the topic of Client appeared euthymic; affect was congruent with mood. (No) current SI/HI/AH/VH. </p>
          <p style="width:100%">'.$data['text_area2'].'</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; border:1px solid black">
      <tr>
        <td  style="width:50%; font-size:12px"><p>ASSESSMENT: The counselor’s or clinician’s assessment of the situation, the session, and the patient’s condition, prognosis, response to intervention, and progress in achieving treatment plan goals/objectives. This may also include the diagnosis with a list of symptoms and information around a differential diagnosis.</p>
        </td>
        <td style="width:50%;font-size:12px; vertical-align:unset;">
          <p>A: Client is in (description of client’s current state of change)</p>
          <p style="width:100%">'.$data['text_area3'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border:1px solid black">
      <tr>
        <td  style="width:50%;vertical-align:unset; border:1px solid black"><p>PLAN: The treatment plan moving forward, based on the clinical information acquired and the assessment.</p>
        </td>
        <td style="width:50%; border:1px solid black">
          <p>P: Clinician is scheduled to meet with the client during the next group session to review additional relapse prevention strategies and coping skills congruent to maintaining her sobriety and to discuss essential topics discussed in group</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border:1px solid black">
      <tr>
        <td  style="width:40%; border:1px solid black"><p>(Name and credentials) '.$data['name_cred'].'</p>
        </td>
        <td style="width:40%; border:1px solid black">
          <p>Counselor Signature:';
          if($data['cou_sign']){
            $print.=' <img src="data:image/png;base64,'.$data['cou_sign'].'" width="100px" height="50px"></p>';
          }
         

        $print.='</td>
        <td style="width:20%; border:1px solid black">
          <p>Date: '.$data['date1'].'</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; border:1px solid black">
      <tr>
        <td  style="width:40%; border:1px solid black"><p>'.$data['text1'].'</p>
        </td>
        <td style="width:40%; border:1px solid black">
          <p>Clinical Supervisor: ';
          if($data['clini_super']){
          $print.='<img src="data:image/png;base64,'.$data['clini_super'].'" width="100px" height="50px"></p>';
          }
         $print.='</td>
        <td style="width:20%; border:1px solid black">
          <p>Date: '.$data['date2'].'</p>
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
