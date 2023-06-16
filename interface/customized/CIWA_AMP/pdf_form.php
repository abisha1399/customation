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
$data = sqlQuery("select * from form_CIWA_AMP where id='".$id."'");
if ($data)
{
  $name = $data['name'];
  $dob = $data['dob'];

  if($data['male_female']=='1' && $data['male_female']!="")
  {
    $male_female ='checked="checked"';
  }
  if($data['male_female1']=='2' && $data['male_female1']!="")
  {
    $male_female1 ='checked="checked"';
  }

  if($data['rating0']=='0' && $data['rating0']!="")
  {
    $rating0 ='checked="checked"';
  }
  if($data['rating1']=='1' && $data['rating1']!="")
  {
    $rating1 ='checked="checked"';
  }
  if($data['rating2']=='2' && $data['rating2']!="")
  {
    $rating2 ='checked="checked"';
  }
  if($data['rating3']=='3' && $data['rating3']!="")
  {
    $rating3 ='checked="checked"';
  }
  if($data['rating4']=='4' && $data['rating4']!="")
  {
    $rating4 ='checked="checked"';
  }
  if($data['rating5']=='5' && $data['rating5']!="")
  {
    $rating5 ='checked="checked"';
  }
  if($data['rating6']=='6' && $data['rating6']!="")
  {
    $rating6 ='checked="checked"';
  }
  if($data['rating7']=='7' && $data['rating7']!="")
  {
    $rating7 ='checked="checked"';
  }
  $dobs = $data['dobs'];
  $times = $data['times'];

  $date1 = $data['date1'];
  $date2 = $data['date2'];
  $date3 = $data['date3'];
  $date4 = $data['date4'];
  $date5 = $data['date5'];
  $date6 = $data['date6'];
  $date7 = $data['date7'];
  $date8 = $data['date8'];
  $date9 = $data['date9'];
  $date10 = $data['date10'];

  $time1 = $data['time1'];
  $time2 = $data['time2'];
  $time3 = $data['time3'];
  $time4 = $data['time4'];
  $time5 = $data['time5'];
  $time6 = $data['time6'];
  $time7 = $data['time7'];
  $time8 = $data['time8'];
  $time9 = $data['time9'];
  $time10 = $data['time10'];

  $bal1 = $data['bal1'];
  $bal2 = $data['bal2'];
  $bal3 = $data['bal3'];
  $bal4 = $data['bal4'];
  $bal5 = $data['bal5'];
  $bal6 = $data['bal6'];
  $bal7 = $data['bal7'];
  $bal8 = $data['bal8'];
  $bal9 = $data['bal9'];
  $bal10 = $data['bal10'];


    $print = '
    <table style="border-collapse:collapse;border-spacing:0;width: 100%;">
      <tr style="display:inline-flex;padding-top: 50px;">
        <td>
          <p style="font-size: 14px;font-weight: 600;">Amphetamine Use Withdrawal Scale</p>
        </td>
        <td>
          <p>Name: '.$name.'</p>
        </td>
      </tr>
    </table>
    <table>
      <tr style="display:inline-flex;padding-top:50px;">
        <td style="padding-left:384px;">
          <p>DOB: '.$dob.' <span><input type="checkbox" name="male_female" value="" '.$male_female.'>M <input type="checkbox" name="male_female1" value="" '.$male_female1.'>F</span></p>
        </td>
      </tr>
    </table>
    <p  style="font-size: 14px;font-weight: 600;text-align: center;padding-top: 26px;padding-bottom: 15px;">Amphetamine Use Withdrawal Scale</p>
    <p  style="font-size: 14px;font-weight: 600;text-align: center;">(CIWA-A)</p>

    <table style="width:100%; border: 1px soild block;">
      <tr>
        <td style="width:50%; border:1px solid black;"><h5>Ratings:<h5>
          <h5><input type="checkbox" name="rating0" value="" '.$rating0.'>0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="rating1" value="" '.$rating1.'>1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="checkbox" name="rating2" value="" '.$rating2.'>2 <input type="checkbox" name="rating3" value="" '.$rating3.'>3 &nbsp;&nbsp;&nbsp; <input type="checkbox" name="rating4" value="" '.$rating4.'>4 &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="rating5" value="" '.$rating5.'>5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="checkbox" name="rating6" value="" '.$rating6.'>6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="rating7" value="" '.$rating7.'>7</h5>
          <h4>Nill &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mind&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; moderate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;very&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;severe</h4>
        </td>
        <!--<td style="border:1px solid black;" >
          <h5>Pupil size</h5>
          <td style="height:5px;
          width:5px;
          background-color:black;
          border-radius:50%;
          display: inline-block;
          margin-right:30px;"></td>

          <td style="height:8px;
          width:8px;
          background-color:black;
          border-radius:50%;
          display: inline-block;
          margin-right:30px;"></td>

          <td style="height:12px;
          width:12px;
          background-color:black;
          border-radius:50%;
          display: inline-block;
          margin-right:30px;"></td>

          <td style="height:15px;
          width:15px;
          background-color:black;
          border-radius:50%;
          display: inline-block;
          margin-right:30px;"></td>

          <td style="height:18px;
          width:18px;
          background-color:black;
          border-radius:50%;
          display: inline-block;
          margin-right:30px;"></td>

          <td style="height:21px;
          width:21px;
          background-color:black;
          border-radius:50%;
          display: inline-block;
          margin-right:30px;"></td>

          <td style="height:24px;
          width:24px;
          background-color:black;
          border-radius:50%;
          display: inline-block;
          margin-right:30px;"></td>

          <td style="height:27px;
          width:27px;
          background-color:black;
          border-radius:50%;
          display: inline-block;
          margin-right:30px;"></td>

          <td style="padding-right:25px;">1</td>
          <td style="padding-right:35px;">2</td>
          <td style="padding-right:35px;">3</td>
          <td style="padding-right:35px;">4</td>
          <td style="padding-right:35px;">5</td>
          <td style="padding-right:35px;">6</td>
          <td style="padding-right:35px;">7</td>
          <td style="padding-right:35px;">8 mm</td>
        </td>-->
      </tr>
    </table>
    <br>
    <table style="width:100%;">
          <tr>
            <td style="width:30%; border:1px solid black;"  rowspan="3">
              <p>Date &amp; Time of Last Use</p>
              <p style="width:70%;">Date: '.$dobs.'</p>
              <p style="width:60%;">Time: '.$times.'</p>
            </td>
            <td style="width:10%; border:1px solid black;"  >
              <p>Date</p>
            </td>
            <td style="width:6%;border:1px solid black;">'.$date1.'</td>
            <td style="width:6%;border:1px solid black;"> '.$date2.'</td>
            <td  style="width:6%;border:1px solid black;"> '.$date3.'</td>
            <td  style="width:6%;border:1px solid black;"> '.$date4.'</td>
            <td  style="width:6%;border:1px solid black;"> '.$date5.'</td>
            <td  style="width:6%;border:1px solid black;"> '.$date6.'</td>
            <td  style="width:6%;border:1px solid black;"> '.$date7.'</td>
            <td  style="width:6%;border:1px solid black;"> '.$date8.'</td>
            <td  style="width:6%;border:1px solid black;"> '.$date9.'</td>
            <td  style="width:6%;border:1px solid black;"> '.$date10.'</td>
          </tr>
          <tr>
            <td style="border:1px solid black;" >
              <p>Time</p>
            </td>
            <td  style="border:1px solid black;">'.$time1.'</td>
            <td  style="border:1px solid black;">'.$time2.'</td>
            <td  style="border:1px solid black;">'.$time3.'</td>
            <td  style="border:1px solid black;">'.$time4.'</td>
            <td  style="border:1px solid black;">'.$time5.'</td>
            <td  style="border:1px solid black;">'.$time6.'</td>
            <td  style="border:1px solid black;">'.$time7.'</td>
            <td  style="border:1px solid black;">'.$time8.'</td>
            <td  style="border:1px solid black;">'.$time9.'</td>
            <td  style="border:1px solid black;">'.$time10.'</td>
          </tr>
          <tr>
            <td style="border:1px solid black;" >
              <p>BAL</p>
            </td>
            <td  style="border:1px solid black;">'.$bal1.'</td>
            <td  style="border:1px solid black;">'.$bal2.'</td>
            <td  style="border:1px solid black;">'.$bal3.'</td>
            <td  style="border:1px solid black;">'.$bal4.'</td>
            <td  style="border:1px solid black;">'.$bal5.'</td>
            <td  style="border:1px solid black;">'.$bal6.'</td>
            <td  style="border:1px solid black;">'.$bal7.'</td>
            <td  style="border:1px solid black;">'.$bal8.'</td>
            <td  style="border:1px solid black;">'.$bal9.'</td>
            <td  style="border:1px solid black;">'.$bal10.'</td>
          </tr>
      </table>
      <br>

      <table style="width:100%;">
        <tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
            <p><b>AGITATION:</b> Observation</p>
            <p>  0 - Normal activity</p>
            <p>  1 - Somewhat more than normal
              activity</p>
              <p>  2</p>
              <p> 3</p>
              <p> 4 - Moderately fidgety and restless</p>
              <p> 5</p>
              <p> 6</p>
              <p> 7 - Paces back and forth or
              constantly thrashes about</p>
          </td>
          <td  style="width:4%;border:1px solid black;">'.$agitation1.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation2.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation3.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation4.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation5.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation6.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation7.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation8.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation9.'</td>
          <td  style="width:4%;border:1px solid black;">'.$agitation10.'</td>
        </tr>
        <tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
          <p> PARANOIA: Ask “Do you feel
            people are paying special attention
            to you? Do you feel anyone is out to
            get you or give you a hard time?</p>
            <p>0 - No paranoia</p>
            <p>1 - Mildly suspicious</p>
            <p> 2</p>
            <p> 3</p>
            <p> 4 - Moderately paranoid or
            suspicious.</p>
            <p>5</p>
            <p> 6</p>
            <p> 7 - Severely paranoid with
            delusions of persecution  </p>
          </td>
          <td  style="border:1px solid black;">'.$paranoia1.'</td>
          <td  style="border:1px solid black;">'.$paranoia2.'</td>
          <td  style="border:1px solid black;">'.$paranoia3.'</td>
          <td  style="border:1px solid black;">'.$paranoia4.'</td>
          <td  style="border:1px solid black;">'.$paranoia5.'</td>
          <td  style="border:1px solid black;">'.$paranoia6.'</td>
          <td  style="border:1px solid black;">'.$paranoia7.'</td>
          <td  style="border:1px solid black;">'.$paranoia8.'</td>
          <td  style="border:1px solid black;">'.$paranoia9.'</td>
          <td  style="border:1px solid black;">'.$paranoia10.'</td>

        </tr>
        <tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
            <p><b>Paroxysmal Sweats:</b></p>
            <p>0 no sweat visible</p>
            <p>1</p>
            <p>2</p>
            <p>3</p>
            <p>4 beads of sweat viable on
            forehead</p>
            <p>5</p>
            <p>6</p>
            <p> 7 drenching sweat</p>
          </td>
          <td  style="border:1px solid black;">'.$paroxysmal1.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal2.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal3.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal4.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal5.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal6.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal7.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal8.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal9.'</td>
          <td  style="border:1px solid black;">'.$paroxysmal10.'</td>

        </tr>
        <tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
            <p><b>Anxiety:</b> Ask, “Do you feel anxious?”</p>
            <p>0 - no anxiety</p>
            <p>1 - mild anxiety</p>
            <p>2</p>
            <p>3</p>
            <p>4 - moderately anxious, or guarded,
            so anxiety is inferred</p>
            <p>5</p>
            <p>6</p>
            <p>7 - panic state or constantly trashing
            out</p>
          </td>
          <td  style="border:1px solid black;">'.$anxiety1.'</td>
          <td  style="border:1px solid black;">'.$anxiety2.'</td>
          <td  style="border:1px solid black;">'.$anxiety3.'</td>
          <td  style="border:1px solid black;">'.$anxiety4.'</td>
          <td  style="border:1px solid black;">'.$anxiety5.'</td>
          <td  style="border:1px solid black;">'.$anxiety6.'</td>
          <td  style="border:1px solid black;">'.$anxiety7.'</td>
          <td  style="border:1px solid black;">'.$anxiety8.'</td>
          <td  style="border:1px solid black;">'.$anxiety9.'</td>
          <td  style="border:1px solid black;">'.$anxiety10.'</td>

        </tr><tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
            <p><b>DEPRESSION:</b> Ask “Do you feel
            sad or depressed?” If yes, “On a
            scale of one to seven how
            depressed do you feel?”</p>
            <p>0 - None</p>
            <p>1 - Mild depression</p>
            <p>2</p>
            <p>3</p>
            <p>4 - Moderate depressed most of the
            day</p>
            <p>5</p>
            <p>6</p>
            <p>7 - Severe depressed all day every
            day.</p>
          </td>
          <td  style="border:1px solid black;">'.$depression1.'</td>
          <td  style="border:1px solid black;">'.$depression2.'</td>
          <td  style="border:1px solid black;">'.$depression3.'</td>
          <td  style="border:1px solid black;">'.$depression4.'</td>
          <td  style="border:1px solid black;">'.$depression5.'</td>
          <td  style="border:1px solid black;">'.$depression6.'</td>
          <td  style="border:1px solid black;">'.$depression7.'</td>
          <td  style="border:1px solid black;">'.$depression8.'</td>
          <td  style="border:1px solid black;">'.$depression9.'</td>
          <td  style="border:1px solid black;">'.$depression10.'</td>
        </tr>
        <tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
            <p><b>CRAVING:</b> Ask “Are you craving
            drugs or alcohol?</p>
            <p>0 - No craving</p>
            <p>1 - Mild or occasionally thinking
            about drug use</p>
            <p>2</p>
            <p>3</p>
            <p>4 - Moderate craving drug use
            throughout the day.</p>
            <p>5</p>
            <p>6</p>
            <p>7 - Severe can’t stop craving.</p>
          </td>
          <td  style="border:1px solid black;">'.$craving1.'</td>
          <td  style="border:1px solid black;">'.$craving2.'</td>
          <td  style="border:1px solid black;">'.$craving3.'</td>
          <td  style="border:1px solid black;">'.$craving4.'</td>
          <td  style="border:1px solid black;">'.$craving5.'</td>
          <td  style="border:1px solid black;">'.$craving6.'</td>
          <td  style="border:1px solid black;">'.$craving7.'</td>
          <td  style="border:1px solid black;">'.$craving8.'</td>
          <td  style="border:1px solid black;">'.$craving9.'</td>
          <td  style="border:1px solid black;">'.$craving10.'</td>
        </tr>
        <tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
            <p><b>Orientation Clouding of
            Sensorium:</b> Ask “What day is it,
            where are you, who am I.”</p>
            <br>
            <p>0 oriented and can do serial
            additions</p>
            <p>1 can’t do serial additions uncertain
            about dates</p>
            <p>2 disoriented by date by 2 days</p>
            <p>3 disoriented by date more then
            day</p>
            <p>4 disoriented of place, and or
            person</p>
          </td>
          <td  style="border:1px solid black;">'.$orientation1.'</td>
          <td  style="border:1px solid black;">'.$orientation2.'</td>
          <td  style="border:1px solid black;">'.$orientation3.'</td>
          <td  style="border:1px solid black;">'.$orientation4.'</td>
          <td  style="border:1px solid black;">'.$orientation5.'</td>
          <td  style="border:1px solid black;">'.$orientation6.'</td>
          <td  style="border:1px solid black;">'.$orientation7.'</td>
          <td  style="border:1px solid black;">'.$orientation8.'</td>
          <td  style="border:1px solid black;">'.$orientation9.'</td>
          <td  style="border:1px solid black;">'.$orientation10.'</td>
        </tr>
        <tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
            <p><b>Visual Disturbances:</b> Ask, “Does
            the light appear to be too bright? Is
            the color different? Does it hurt your
            eyes? Are you seeing anything that is
            disturbing you? Are you seeing things
            you know are not there?”</p>
            <p>0 not present</p>
            <p>1 very mild sensitivity</p>
            <p>2 mild sensitivity</p>
            <p>3 moderate sensitivity</p>
            <p>4 moderately severe hallucinations</p>
            <p>5 severe sensitivity</p>
            <p>6 extremely severe hallucinations</p>
            <p>7 continuous hallucinations</p>
          </td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_1.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_2.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_3.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_4.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_5.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_6.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_7.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_8.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_9.'</td>
          <td  style="width: 20%;border:1px solid black;">'.$vis_dis_10.'</td>
        </tr>
        <tr>
          <td style="width:60%; border:1px solid black;font-size:35px;">
            <p><b>Tactile Disturbance:</b> Ask, “Any
            itching,
            Pins and needle sensation, burning,
            Numbness, or feel like bugs are
            Crawling under skin?”</p>
            <p>0 none</p>
            <p>1 very mild itching, burning, pins &amp;
            Needles or numbness</p>
            <p>2 mild itching, pins, needles, burning
            Or numbness</p>
           <p>3 moderate itching, pins, needles,
            burning
            Or numbness</p>
            <p>4 moderate severe hallucinations</p>
            <p>5 severe hallucinations</p>
            <p>6 extremely severe hallucinations</p>
            <p>7 continuous hallucinations</p>
          </td>
          <td  style="border:1px solid black;">'.$tactile1.'</td>
          <td  style="border:1px solid black;">'.$tactile2.'</td>
          <td  style="border:1px solid black;">'.$tactile3.'</td>
          <td  style="border:1px solid black;">'.$tactile4.'</td>
          <td  style="border:1px solid black;">'.$tactile5.'</td>
          <td  style="border:1px solid black;">'.$tactile6.'</td>
          <td  style="border:1px solid black;">'.$tactile7.'</td>
          <td  style="border:1px solid black;">'.$tactile8.'</td>
          <td  style="border:1px solid black;">'.$tactile9.'</td>
          <td  style="border:1px solid black;">'.$tactile10.'</td>

        </tr>
        </table>
        <br>

        <table style="width:100%;">
        <tr>
          <td style="width:40%; border:1px solid black;">
            <p><b>Auditory Disturbances:</b> Ask “Are
            you more aware of sounds? Are they
            harsh? Do they frighten you? Are you
            hearing. Anything that frightens you?
            Are you Hearing things you are not
            aware of?”</p>
            <p>0 not present</p>
            <p>1 very mild harshness or ability to
            frighten</p>
            <p>2 mild harshness or ability to
            frighten</p>
            <p> 3 moderate harshness or ability to
            frighten</p>
            <p>4 Moderately severe hallucinations</p>
            <p>5 Severe Hallucinations</p>
            <p> 6 Extremely severe hallucinations</p>
            <p> 7 Continuous hallucinations</p>
          </td>
          <td  style="width:6%;border:1px solid black;">'.$auditory1.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory2.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory3.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory4.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory5.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory6.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory7.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory8.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory9.'</td>
          <td  style="width:6%;border:1px solid black;">'.$auditory10.'</td>

        </tr>
        <tr>
          <td style="width:20%; border:1px solid black;">
            <p><b>Visual Disturbances:</b> Ask, “Does the
            light appear to be too bright? Is the
            color different? Does it hurt your eyes?
            Are you seeing anything that is
            disturbing you? Are you seeing things
            you know are not there?”</p>
            <p> 0 not present</p>
            <p>1 very mild sensitivity</p>
            <p>2 mild sensitivity</p>
            <p>3 moderate sensitivity</p>
            <p>4 moderately severe hallucinations</p>
            <p>5 severe sensitivity</p>
            <p>6 extremely severe hallucinations</p>
            <p>7 continuous hallucinations</p>
          </td>
          <td  style="border:1px solid black;">'.$visual1.'</td>
          <td  style="border:1px solid black;">'.$visual2.'</td>
          <td  style="border:1px solid black;">'.$visual3.'</td>
          <td  style="border:1px solid black;">'.$visual4.'</td>
          <td  style="border:1px solid black;">'.$visual5.'</td>
          <td  style="border:1px solid black;">'.$visual6.'</td>
          <td  style="border:1px solid black;">'.$visual7.'</td>
          <td  style="border:1px solid black;">'.$visual8.'</td>
          <td  style="border:1px solid black;">'.$visual9.'</td>
          <td  style="border:1px solid black;">'.$visual10.'</td>
        </tr>
      </table>
      <br>

      <table  style="width:100%;">
        <tr>
          <td style="width:40%; border:1px solid black;">
            <P>Total Score</P>
            <P>Scores:</P>
            <P>0-8 = indicates mild withdrawal</P>
            <P>8-20 = indicates moderate withdrawal</P>
            <P>20+ = indicates severe withdrawal</P>
          </td>
          <td  style="width: 6%;border:1px solid black;">'.$scores1.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores2.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores3.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores4.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores5.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores6.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores7.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores8.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores9.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$scores10.'</td>
        </tr>
      </table>
      <br>

      <table style="width:100%;">
        <tr>
          <td style="width:30%; border:1px solid black;">
            Blood Pressure
          </td>
          <td  style="width: 6%;border:1px solid black;">'.$blood1.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood2.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood3.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood4.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood5.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood6.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood7.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood8.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood9.'</td>
          <td  style="width: 6%;border:1px solid black;">'.$blood10.'</td>
        </tr>
        <tr>
          <td style="border:1px solid black;">
            Pulse
          </td>
          <td  style="border:1px solid black;">'.$pulse1.'</td>
          <td  style="border:1px solid black;">'.$pulse2.'</td>
          <td  style="border:1px solid black;">'.$pulse3.'</td>
          <td  style="border:1px solid black;">'.$pulse4.'</td>
          <td  style="border:1px solid black;">'.$pulse5.'</td>
          <td  style="border:1px solid black;">'.$pulse6.'</td>
          <td  style="border:1px solid black;">'.$pulse7.'</td>
          <td  style="border:1px solid black;">'.$pulse8.'</td>
          <td  style="border:1px solid black;">'.$pulse9.'</td>
          <td  style="border:1px solid black;">'.$pulse10.'</td>
        </tr>
        <tr>
          <td style="border:1px solid black;">
            Temperature
          </td>
          <td  style="border:1px solid black;">'.$temperature1.'</td>
          <td  style="border:1px solid black;">'.$temperature2.'</td>
          <td  style="border:1px solid black;">'.$temperature3.'</td>
          <td  style="border:1px solid black;">'.$temperature4.'</td>
          <td  style="border:1px solid black;">'.$temperature5.'</td>
          <td  style="border:1px solid black;">'.$temperature6.'</td>
          <td  style="border:1px solid black;">'.$temperature7.'</td>
          <td  style="border:1px solid black;">'.$temperature8.'</td>
          <td  style="border:1px solid black;">'.$temperature9.'</td>
          <td  style="border:1px solid black;">'.$temperature10.'</td>
        </tr>
        <tr>
          <td style="border:1px solid black;">
            Respirations
          </td>
          <td  style="border:1px solid black;">'.$respirations1.'</td>
          <td  style="border:1px solid black;">'.$respirations2.'</td>
          <td  style="border:1px solid black;">'.$respirations3.'</td>
          <td  style="border:1px solid black;">'.$respirations4.'</td>
          <td  style="border:1px solid black;">'.$respirations5.'</td>
          <td  style="border:1px solid black;">'.$respirations6.'</td>
          <td  style="border:1px solid black;">'.$respirations7.'</td>
          <td  style="border:1px solid black;">'.$respirations8.'</td>
          <td  style="border:1px solid black;">'.$respirations9.'</td>
          <td  style="border:1px solid black;">'.$respirations10.'</td>
        </tr>
      </table>
      <br>
      <br>

      <table style="width:100%;">
        <tr>
          <td rowspan="3" style="width:20%;border:1px solid black;">
            <p>
              Pupils
              Reacts + no reaction -
              Brisk B sluggish s
            </p>
          </td>
        </tr>
        <tr>
          <td style="width:10%; border:1px solid black;">Size in mm</td>
          <td  style="border:1px solid black;">'.$size1.'</td>
          <td  style="border:1px solid black;">'.$size2.'</td>
          <td  style="border:1px solid black;">'.$size3.'</td>
          <td  style="border:1px solid black;">'.$size4.'</td>
          <td  style="border:1px solid black;">'.$size5.'</td>
          <td  style="border:1px solid black;">'.$size6.'</td>
          <td  style="border:1px solid black;">'.$size7.'</td>
          <td  style="border:1px solid black;">'.$size8.'</td>
          <td  style="border:1px solid black;">'.$size9.'</td>
          <td  style="border:1px solid black;">'.$size10.'</td>
        </tr>
        <tr>
          <td style="border:1px solid black;">Reaction</td>
          <td  style="border:1px solid black;">'.$reaction1.'</td>
          <td  style="border:1px solid black;">'.$reaction2.'</td>
          <td  style="border:1px solid black;">'.$reaction3.'</td>
          <td  style="border:1px solid black;">'.$reaction4.'</td>
          <td  style="border:1px solid black;">'.$reaction5.'</td>
          <td  style="border:1px solid black;">'.$reaction6.'</td>
          <td  style="border:1px solid black;">'.$reaction7.'</td>
          <td  style="border:1px solid black;">'.$reaction8.'</td>
          <td  style="border:1px solid black;">'.$reaction9.'</td>
          <td  style="border:1px solid black;">'.$reaction10.'</td>
        </tr>
      </table>
      <br>
      <br>

      <table style="width:100%;">
        <tr>
          <td style="width:30%; border:1px solid black;">Medication</td>
          <td  style="border:1px solid black;">'.$medication1.'</td>
          <td  style="border:1px solid black;">'.$medication2.'</td>
          <td  style="border:1px solid black;">'.$medication3.'</td>
          <td  style="border:1px solid black;">'.$medication4.'</td>
          <td  style="border:1px solid black;">'.$medication5.'</td>
          <td  style="border:1px solid black;">'.$medication6.'</td>
          <td  style="border:1px solid black;">'.$medication7.'</td>
          <td  style="border:1px solid black;">'.$medication8.'</td>
          <td  style="border:1px solid black;">'.$medication9.'</td>
          <td  style="border:1px solid black;">'.$medication10.'</td>
        </tr>
        <tr>
          <td style="border:1px solid black;">Nurse Initial</td>
          <td  style="border:1px solid black;">'.$nurse1.'</td>
          <td  style="border:1px solid black;">'.$nurse2.'</td>
          <td  style="border:1px solid black;">'.$nurse3.'</td>
          <td  style="border:1px solid black;">'.$nurse4.'</td>
          <td  style="border:1px solid black;">'.$nurse5.'</td>
          <td  style="border:1px solid black;">'.$nurse6.'</td>
          <td  style="border:1px solid black;">'.$nurse7.'</td>
          <td  style="border:1px solid black;">'.$nurse8.'</td>
          <td  style="border:1px solid black;">'.$nurse9.'</td>
          <td  style="border:1px solid black;">'.$nurse10.'</td>
        </tr>
      </table>
    ';
}
else{
    $print="Not Found";
}

$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($print);
$file='pdf/'.time().'.pdf';
$mpdf->Output($file,'I');
?>
