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
    $data = sqlQuery("select * from form_beck_depression_inventory where id='".$id."'");
    if ($data) 
    {   
        $crtn = $data['crtn'];
        $crf_no = $data['crf_no'];
        $patient_inits = $data['patient_inits'];
        $date = $data['date'];
        $occupation = $data['occupation'];
        $education = $data['education'];
        $total_score = $data['total_score'];
        
        if($data['sadness']==0 && $data['sadness']!="")
        { 
          $sadness0 ='checked="checked"';
        }
        elseif($data['sadness']==1 && $data['sadness']!="")
        { 
          $sadness1 ='checked="checked"';
        }
        elseif($data['sadness']==2 && $data['sadness']!="")
        { 
          $sadness2 ='checked="checked"';
        }
        elseif($data['sadness']==3 && $data['sadness']!="")
        { 
          $sadness3 ='checked="checked"';
        }
        else{
          $sadness0 ='';
          $sadness1 ='';
          $sadness2 ='';
          $sadness3 ='';
        }
        echo"<br> value : ".$data['pessimism'];
        if($data['pessimism']==0 && $data['pessimism']!="")
        { 
          $pessimism0 ='checked="checked"';
        }
        else{
          $pessimism0 ='';
        }
        if($data['pessimism']==1 && $data['pessimism']!="")
        { 
          $pessimism1 ='checked="checked"';
        }
        else{
          $pessimism1 ='';
        }
        if($data['pessimism']==2 && $data['pessimism']!="")
        { 
          $pessimism2 ='checked="checked"';
        }
        else{
          $pessimism2 ='';
        }
        if($data['pessimism']==3 && $data['pessimism']!="")
        { 
          $pessimism3 ='checked="checked"';
        }
        else{
          $pessimism3 ='';
        }

        if($data['past_failure']==0 && $data['past_failure']!="")
        { 
          $past_failure0 ='checked="checked"';
        }
        if($data['past_failure']==1 && $data['past_failure']!="")
        { 
          $past_failure1 ='checked="checked"';
        }
        if($data['past_failure']==2 && $data['past_failure']!="")
        { 
          $past_failure2 ='checked="checked"';
        }
        if($data['past_failure']==3 && $data['past_failure']!="")
        { 
          $past_failure3 ='checked="checked"';
        }

        if($data['loss_of_pleasure']==0 && $data['loss_of_pleasure']!="")
        { 
          $loss_of_pleasure0 ='checked="checked"';
        }
        if($data['loss_of_pleasure']==1 && $data['loss_of_pleasure']!="")
        { 
          $loss_of_pleasure1 ='checked="checked"';
        }
        if($data['loss_of_pleasure']==2 && $data['loss_of_pleasure']!="")
        { 
          $loss_of_pleasure2 ='checked="checked"';
        }
        if($data['loss_of_pleasure']==3 && $data['loss_of_pleasure']!="")
        { 
          $loss_of_pleasure3 ='checked="checked"';
        }

        if($data['guilty_feelings']==0 && $data['guilty_feelings']!="")
        { 
          $guilty_feelings0 ='checked="checked"';
        }
        if($data['guilty_feelings']==1 && $data['guilty_feelings']!="")
        { 
          $guilty_feelings1 ='checked="checked"';
        }
        if($data['guilty_feelings']==2 && $data['guilty_feelings']!="")
        { 
          $guilty_feelings2 ='checked="checked"';
        }
        if($data['guilty_feelings']==3 && $data['guilty_feelings']!="")
        { 
          $guilty_feelings3 ='checked="checked"';
        }

        if($data['punishment_feelings']==0 && $data['punishment_feelings']!="")
        { 
          $punishment_feelings0 ='checked="checked"';
        }
        if($data['punishment_feelings']==1 && $data['punishment_feelings']!="")
        { 
          $punishment_feelings1 ='checked="checked"';
        }
        if($data['punishment_feelings']==2 && $data['punishment_feelings']!="")
        { 
          $punishment_feelings2 ='checked="checked"';
        }
        if($data['punishment_feelings']==3 && $data['punishment_feelings']!="")
        { 
          $punishment_feelings3 ='checked="checked"';
        }

        if($data['self_dislike']==0 && $data['self_dislike']!="")
        { 
          $self_dislike0 ='checked="checked"';
        }
        if($data['self_dislike']==1 && $data['self_dislike']!="")
        { 
          $self_dislike1 ='checked="checked"';
        }
        if($data['self_dislike']==2 && $data['self_dislike']!="")
        { 
          $self_dislike2 ='checked="checked"';
        }
        if($data['self_dislike']==3 && $data['self_dislike']!="")
        { 
          $self_dislike3 ='checked="checked"';
        }

        if($data['self_criti']==0 && $data['self_criti']!="")
        { 
          $self_criti0 ='checked="checked"';
        }
        if($data['self_criti']==1 && $data['self_criti']!="")
        { 
          $self_criti1 ='checked="checked"';
        }
        if($data['self_criti']==2 && $data['self_criti']!="")
        { 
          $self_criti2 ='checked="checked"';
        }
        if($data['self_criti']==3 && $data['self_criti']!="")
        { 
          $self_criti3 ='checked="checked"';
        }

        if($data['suicidal_tho']==0 && $data['suicidal_tho']!="")
        { 
          $suicidal_tho0 ='checked="checked"';
        }
        if($data['suicidal_tho']==1 && $data['suicidal_tho']!="")
        { 
          $suicidal_tho1 ='checked="checked"';
        }
        if($data['suicidal_tho']==2 && $data['suicidal_tho']!="")
        { 
          $suicidal_tho2 ='checked="checked"';
        }
        if($data['suicidal_tho']==3 && $data['suicidal_tho']!="")
        { 
          $suicidal_tho3 ='checked="checked"';
        }

        if($data['crying']==0 && $data['crying']!="")
        { 
          $crying0 ='checked="checked"';
        }
        if($data['crying']==1 && $data['crying']!="")
        { 
          $crying1 ='checked="checked"';
        }
        if($data['crying']==2 && $data['crying']!="")
        { 
          $crying2 ='checked="checked"';
        }
        if($data['crying']==3 && $data['crying']!="")
        { 
          $crying3 ='checked="checked"';
        }

        if($data['agitation']==0 && $data['agitation']!="")
        { 
          $agitation0 ='checked="checked"';
        }
        if($data['agitation']==1 && $data['agitation']!="") 
        { 
          $agitation1 ='checked="checked"';
        }
        if($data['agitation']==2 && $data['agitation']!="")
        { 
          $agitation2 ='checked="checked"';
        }
        if($data['agitation']==3 && $data['agitation']!="")
        { 
          $agitation3 ='checked="checked"';
        }

        if($data['loss_of_interest']==0 && $data['loss_of_interest']!="")
        { 
          $loss_of_interest0 ='checked="checked"';
        }
        if($data['loss_of_interest']==1 && $data['loss_of_interest']!="")
        { 
          $loss_of_interest1 ='checked="checked"';
        }
        if($data['loss_of_interest']==2 && $data['loss_of_interest']!="")
        { 
          $loss_of_interest2 ='checked="checked"';
        }
        if($data['loss_of_interest']==3 && $data['loss_of_interest']!="")
        { 
          $loss_of_interest3 ='checked="checked"';
        }

        if($data['indecisiveness']==0 && $data['indecisiveness']!="")
        { 
          $indecisiveness0 ='checked="checked"';
        }
        if($data['indecisiveness']==1 && $data['indecisiveness']!="")
        { 
          $indecisiveness1 ='checked="checked"';
        }
        if($data['indecisiveness']==2 && $data['indecisiveness']!="")
        { 
          $indecisiveness2 ='checked="checked"';
        }
        if($data['indecisiveness']==3 && $data['indecisiveness']!="")
        { 
          $indecisiveness3 ='checked="checked"';
        }

        if($data['worthlessness']==0 && $data['worthlessness']!="")
        { 
          $worthlessness0 ='checked="checked"';
        }
        if($data['worthlessness']==1 && $data['worthlessness']!="")
        { 
          $worthlessness1 ='checked="checked"';
        }
        if($data['worthlessness']==2 && $data['worthlessness']!="")
        { 
          $worthlessness2 ='checked="checked"';
        }
        if($data['worthlessness']==3 && $data['worthlessness']!="")
        { 
          $worthlessness3 ='checked="checked"';
        }

        if($data['loss_of_energy']==0 && $data['loss_of_energy']!="")
        { 
          $loss_of_energy0 ='checked="checked"';
        }
        if($data['loss_of_energy']==1 && $data['loss_of_energy']!="")
        { 
          $loss_of_energy1 ='checked="checked"';
        }
        if($data['loss_of_energy']==2 && $data['loss_of_energy']!="")
        { 
          $loss_of_energy2 ='checked="checked"';
        }
        if($data['loss_of_energy']==3 && $data['loss_of_energy']!="")
        { 
          $loss_of_energy3 ='checked="checked"';
        }

        if($data['chg_slp_ptn']==0 && $data['chg_slp_ptn']!="")
        { 
          $chg_slp_ptn0 ='checked="checked"';
        }
        if($data['chg_slp_ptn']==1 && $data['chg_slp_ptn']!="")
        { 
          $chg_slp_ptn1 ='checked="checked"';
        }
        if($data['chg_slp_ptn']==2 && $data['chg_slp_ptn']!="")
        { 
          $chg_slp_ptn2 ='checked="checked"';
        }
        if($data['chg_slp_ptn']==3 && $data['chg_slp_ptn']!="")
        { 
          $chg_slp_ptn3 ='checked="checked"';
        }

        if($data['irritability']==0 && $data['irritability']!="")
        { 
          $irritability0 ='checked="checked"';
        }
        if($data['irritability']==1 && $data['irritability']!="")
        { 
          $irritability1 ='checked="checked"';
        }
        if($data['irritability']==2 && $data['irritability']!="")
        { 
          $irritability2 ='checked="checked"';
        }
        if($data['irritability']==3 && $data['irritability']!="")
        { 
          $irritability3 ='checked="checked"';
        }

        if($data['chg_in_app']==0 && $data['chg_in_app']!="")
        { 
          $chg_in_app0 ='checked="checked"';
        }
        if($data['chg_in_app']==1 && $data['chg_in_app']!="")
        { 
          $chg_in_app1 ='checked="checked"';
        }
        if($data['chg_in_app']==2 && $data['chg_in_app']!="")
        { 
          $chg_in_app2 ='checked="checked"';
        }
        if($data['chg_in_app']==3 && $data['chg_in_app']!="")
        { 
          $chg_in_app3 ='checked="checked"';
        }

        if($data['con_diff']==0 && $data['con_diff']!="")
        { 
          $con_diff0 ='checked="checked"';
        }
        if($data['con_diff']==1 && $data['con_diff']!="")
        { 
          $con_diff1 ='checked="checked"';
        }
        if($data['con_diff']==2 && $data['con_diff']!="")
        { 
          $con_diff2 ='checked="checked"';
        }
        if($data['con_diff']==3 && $data['con_diff']!="")
        { 
          $con_diff3 ='checked="checked"';
        }

        if($data['tired_fati']==0 && $data['tired_fati']!="")
        { 
          $tired_fati0 ='checked="checked"';
        }
        if($data['tired_fati']==1 && $data['tired_fati']!="")
        { 
          $tired_fati1 ='checked="checked"';
        }
        if($data['tired_fati']==2 && $data['tired_fati']!="")
        { 
          $tired_fati2 ='checked="checked"';
        }
        if($data['tired_fati']==3 && $data['tired_fati']!="")
        { 
          $tired_fati3 ='checked="checked"';
        }

        if($data['loss_int_sex']==0 && $data['loss_int_sex']!="")
        { 
          $loss_int_sex0 ='checked="checked"';
        }
        if($data['loss_int_sex']==1 && $data['loss_int_sex']!="")
        { 
          $loss_int_sex1 ='checked="checked"';
        }
        if($data['loss_int_sex']==2 && $data['loss_int_sex']!="")
        { 
          $loss_int_sex2 ='checked="checked"';
        }
        if($data['loss_int_sex']==3 && $data['loss_int_sex']!="")
        { 
          $loss_int_sex3 ='checked="checked"';
        }

        $print = '        
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%;">Beck Depression Inventory</h4></td>
         </tr>
        </table>
        <br>
        <table>
          <tr style="width:25%;">
            <td style="width:25%;">CRTN: '.$crtn.'</td>
            <td style="width:25%;">CRF Number: '.$crf_no.'</td>
            <td style="width:25%;">Patient inits: '.$patient_inits.'</td>
            <td style="width:25%;">Date: '.$date.'</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Occupation: '.$occupation.'</td>
            <td style="width:50%;">Education: '.$education.'</td>
          </tr>
        </table>
        <br><br>
        <table style="width:100%;">
          <tr>
            <td>
              <p style="font-size:14px;text-align: justify;"><b>Instructions:</b> This questionnaire consists of 21 groups of statements. Please read each group of statements carefully, and then pick out the<b>one statement</b> in each group that best describes the way you have been feeling during <b>the past two weeks, including today.</b> Circle the number beside the statemnet you have picked. If several statements in the group seem to apply equally well, circle the highest number for that group. Be sure that you do not choose more than one statement for any group, including Item 16 (Changes in Sleeping Pattern) or Item 18 (Changes in Appetite).</p>
            </td>
          </tr>
        </table>
        <br>
        <table style="width:100%; border: 1px solid black;" >
          <tr>            
            <td style="border: 1px solid black;width: 50%;">
              <p><b>1. Sadness</b></p>
              <p>&emsp;<input type="radio" name="sadness" value="0" '.$sadness0.'>
              I do not feel sad.</p>
              <p>&emsp;<input type="radio" name="sadness" value="1" '.$sadness1.'>
              I feel sad much  of the time.</p>
              <p>&emsp;<input type="radio" name="sadness" value="2" '.$sadness2.'>
              I am sad all the time.</p>
              <p>&emsp;<input type="radio" name="sadness" value="3" '.$sadness3.'>
              I am so sad or unhappy that I cant stand it.</p>
              <br>

              <p><b>2. Pessimism</b></p>
              <p>&emsp;<input type="radio" name="pessimism" value="0" '.$pessimism0.'>
              I am not discouraged about my future.</p>
              <p>&emsp;<input type="radio" name="pessimism" value="1" '.$pessimism1.'>
              I feel more discouraged about my future than I used to be.</p>
              <p>&emsp;<input type="radio" name="pessimism" value="2" '.$pessimism2.'>
              I do not expect things to work put for me.</p>
              <p>&emsp;<input type="radio" name="pessimism" value="3" '.$pessimism3.'>
              I feel my futrue is hopeless and will only get worse.</p>
              <br>

              <p><b>3. Past Failure</b></p>
              <p>&emsp;<input type="radio" name="past_failure" value="0" '.$past_failure0.'>
              I do not feel like a failure.</p>
              <p>&emsp;<input type="radio" name="past_failure" value="1" '.$past_failure1.'>
              I have  failed more than I should have.</p>
              <p>&emsp;<input type="radio" name="past_failure" value="2" '.$past_failure2.'>
              As I look back, I see a lot of Failures.</p>
              <p>&emsp;<input type="radio" name="past_failure" value="3" '.$past_failure3.'>
              I feel I am a total failure as a person.</p>
              <br>

              <p><b>4. Loss of Pleasure</b></p>
              <p>&emsp;<input type="radio" name="loss_of_pleasure" value="0" '.$loss_of_pleasure0.'>
              I get as much pleasure as I ever did from the things I enjoy.</p>
              <p>&emsp;<input type="radio" name="loss_of_pleasure" value="1" '.$loss_of_pleasure1.'>
              I dont enjoy things as much as I used to.</p>
              <p>&emsp;<input type="radio" name="loss_of_pleasure" value="2" '.$loss_of_pleasure2.'>
              I get very little pleasure from the things I used to enjoy.</p>
              <p>&emsp;<input type="radio" name="loss_of_pleasure" value="3" '.$loss_of_pleasure3.'>
              I cant get any little pleasure from the things I used to enjoy.</p>
              <br>

              <p><b>5. Guilty Feelings</b></p>
              <p>&emsp;<input type="radio" name="guilty_feelings" value="0" '.$guilty_feelings0.'>
              I dont feel particularly guilty.</p>
              <p>&emsp;<input type="radio" name="guilty_feelings" value="1" '.$guilty_feelings1.'>
              I feel guilty over many things I have done or should have done.</p>
              <p>&emsp;<input type="radio" name="guilty_feelings" value="2" '.$guilty_feelings2.'>
              I feel quite guilty most of the time.</p>
              <p>&emsp;<input type="radio" name="guilty_feelings" value="3" '.$guilty_feelings3.'>
              I feel guilty all of the time.</p>
              <br>
            </td>

            <td style="border: 1px solid black;width: 50%;">
              <p><b>6. Punishment Feelings</b></p>
              <p>&emsp;<input type="radio" name="punishment_feelings" value="0" '.$punishment_feelings0.'>
              I dont feel a am being punished.</p>
              <p>&emsp;<input type="radio" name="punishment_feelings" value="1" '.$punishment_feelings1.'>
              I feel I may be punished.</p>
              <p>&emsp;<input type="radio" name="punishment_feelings" value="2" '.$punishment_feelings2.'>
              I expect to be punished.</p>
              <p>&emsp;<input type="radio" name="punishment_feelings" value="3" '.$punishment_feelings3.'>
              I feel I am being punished.</p>
              <br>

              <p><b>7. Self-Dislike</b></p>
              <p>&emsp;<input type="radio" name="self_dislike" value="0" '.$self_dislike0.'>
              I feel the same about myself as ever.</p>
              <p>&emsp;<input type="radio" name="self_dislike" value="1" '.$self_dislike1.'>
              I have lost confidence in myself</p>
              <p>&emsp;<input type="radio" name="self_dislike" value="2" '.$self_dislike2.'>
              I am disappointed in myself</p>
              <p>&emsp;<input type="radio" name="self_dislike" value="3" '.$self_dislike3.'>
              I dislike myself.</p>
              <br>

              <p><b>8. Self-Criticalness</b></p>
              <p>&emsp;<input type="radio" name="self_criti" value="0" '.$self_criti0.'>
              I dont criticize or blame myself more than usual.</p>
              <p>&emsp;<input type="radio" name="self_criti" value="1" '.$self_criti1.'>
              I  am more critical of myself than I used to be.</p>
              <p>&emsp;<input type="radio" name="self_criti" value="2" '.$self_criti2.'>
              I criticize myself for all of my faults.</p>
              <p>&emsp;<input type="radio" name="self_criti" value="3" '.$self_criti3.'>
              I blame myself for eveything bat that happens.</p>
              <br>

              <p><b>9. Suicidal Thoughts or wishes</b></p>
              <p>&emsp;<input type="radio" name="suicidal_tho" value="0" '.$suicidal_tho0.'>
              I dont have any thoughts of killing myself.</p>
              <p>&emsp;<input type="radio" name="suicidal_tho" value="1" '.$suicidal_tho1.'>
              I have thoughts of killing myself, but I would not carry them out.</p>
              <p>&emsp;<input type="radio" name="suicidal_tho" value="2" '.$suicidal_tho2.'>
              I would like to kill myself.</p>
              <p>&emsp;<input type="radio" name="suicidal_tho" value="3" '.$suicidal_tho3.'>
              I would kill myself if I had the chance.</p>
              <br>

              <p><b>10. Crying</b></p>
              <p>&emsp;<input type="radio" name="crying" value="0" '.$crying0.'>
              I dont cry anymore than I used to.</p>
              <p>&emsp;<input type="radio" name="crying" value="1" '.$crying1.'>
              I cry more than I used to.</p>
              <p>&emsp;<input type="radio" name="crying" value="2" '.$crying2.'>
              I cry over every little thing.</p>
              <p>&emsp;<input type="radio" name="crying" value="3" '.$crying3.'>
              I feel like crying, but I cant.</p>
              <br>
            </td>
          </tr>
        </table>

        <br>
        <br>
        
        <table style="width:100%; border: 1px solid black;" >
          <tr>            
            <td style="border: 1px solid black;width: 50%;">
              <p><b>11. Agitation</b></p>
              <p>&emsp;<input type="radio" name="agitation" value="0" '.$agitation0.'>
              I am no more restless or wound up than usual.</p>
              <p>&emsp;<input type="radio" name="agitation" value="1" '.$agitation1.'>
              I feel more restless or wound up than usual.</p>
              <p>&emsp;<input type="radio" name="agitation" value="2" '.$agitation2.'>
              I am so restless or agitated that its hard to stay still.</p>
              <p>&emsp;<input type="radio" name="agitation" value="3" '.$agitation3.'>
              I am so restless or agitated that I have to keep moving or doing something.</p>
              <br>

              <p><b>12. Loss of Interest</b></p>
              <p>&emsp;<input type="radio" name="loss_of_interest" value="0" '.$loss_of_interest0.'>
              I have not lost interest in other people or activites.</p>
              <p>&emsp;<input type="radio" name="loss_of_interest" value="1" '.$loss_of_interest1.'>
              I am less interested in other people or things than before.</p>
              <p>&emsp;<input type="radio" name="loss_of_interest" value="2" '.$loss_of_interest2.'>
              I have lost most of my interest in other people or things.</p>
              <p>&emsp;<input type="radio" name="loss_of_interest" value="3" '.$loss_of_interest3.'>
              Its hard to get interested in anything.</p>
              <br>

              <p><b>13. Indecisiveness</b></p>
              <p>&emsp;<input type="radio" name="indecisiveness" value="0" '.$indecisiveness0.'>
              I make decisions about as well as ever.</p>
              <p>&emsp;<input type="radio" name="indecisiveness" value="1" '.$indecisiveness1.'>
              I find it more different to make decisions than usual.</p>
              <p>&emsp;<input type="radio" name="indecisiveness" value="2" '.$indecisiveness2.'>
              I have much greater difficulty in making decisions than I used to.</p>
              <p>&emsp;<input type="radio" name="indecisiveness" value="3" '.$indecisiveness3.'>
              I have trouble making any decisions.</p>
              <br>

              <p><b>14. Worthlessness</b></p>
              <p>&emsp;<input type="radio" name="worthlessness" value="0" '.$worthlessness0.'>
              I do not feel I am worthless.</p>
              <p>&emsp;<input type="radio" name="worthlessness" value="1" '.$worthlessness1.'>
              I dont consider myself as worthwhile and useful as I used to.</p>
              <p>&emsp;<input type="radio" name="worthlessness" value="2" '.$worthlessness2.'>
              I feel more worthless as compared to other people.</p>
              <p>&emsp;<input type="radio" name="worthlessness" value="3" '.$worthlessness3.'>
              I feel utterly worthless.</p>
              <br>

              <p><b>15. Loss of Energy</b></p>
              <p>&emsp;<input type="radio" name="loss_of_energy" value="0" '.$loss_of_energy0.'>
              I have as much energy as ever.</p>
              <p>&emsp;<input type="radio" name="loss_of_energy" value="1" '.$loss_of_energy1.'>
              I have less energy than I used to have.</p>
              <p>&emsp;<input type="radio" name="loss_of_energy" value="2" '.$loss_of_energy2.'>
              I dont have enought enery to do very much.</p>
              <p>&emsp;<input type="radio" name="loss_of_energy" value="3" '.$loss_of_energy3.'>
              I dont have enough energy to do anythings.</p>
              <br>

              <p><b>16. Changes is Sleeping Pattern</b></p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="0" '.$chg_slp_ptn0.'>
              I have not exeprienced any change in my sleeping pattern.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="1" '.$chg_slp_ptn1.'>
              I sleep somewhat more than usual.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="1" '.$chg_slp_ptn1.'>
              I sleep somewhat less than usual.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="2" '.$chg_slp_ptn2.'>
              I sleep a lot more than usual.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="2" '.$chg_slp_ptn2.'>
              I sleep a lot less than usual.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="3" '.$chg_slp_ptn3.'>
              I sleep most of the day.</p>
              <p>&emsp;<input type="radio" name="chg_slp_ptn" value="3" '.$chg_slp_ptn3.'>
              I Wake up 1-2 hours early and cant get back to sleep.</p>
              <br>
            </td>

            <td style="border: 1px solid black; width: 50%;">
              <p><b>17. Irritability</b></p>
              <p>&emsp;<input type="radio" name="irritability" value="0" '.$irritability0.'>
              I am no more irritable than usual.</p>
              <p>&emsp;<input type="radio" name="irritability" value="1" '.$irritability1.'>
              I am more irritable than usual.</p>
              <p>&emsp;<input type="radio" name="irritability" value="2" '.$irritability2.'>
              I am much more irritable than usual.</p>
              <p>&emsp;<input type="radio" name="irritability" value="3" '.$irritability3.'>
              I am irritable all the time.</p>
              <br>

              <p><b>18. Changes is Appetite</b></p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="0" '.$chg_in_app0.'>
              I have not exeprienced any change in my appetite.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="1" '.$chg_in_app1.'>
              My appetite is somewhat less than usual.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="1" '.$chg_in_app1.'>
              My appetite is somewhat greater than usual.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="2" '.$chg_in_app2.'>
              My appetite is much less than before.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="2" '.$chg_in_app2.'>
              My appetite is much greater than usual.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="3" '.$chg_in_app3.'>
              I have no appetite at all.</p>
              <p>&emsp;<input type="radio" name="chg_in_app" value="3" '.$chg_in_app3.'>
              I crave food all the time.</p>
              <br>

              <p><b>19. Concentration Difficulty</b></p>
              <p>&emsp;<input type="radio" name="con_diff" value="0" '.$con_diff0.'>
              I can concentrate as well as ever.</p>
              <p>&emsp;<input type="radio" name="con_diff" value="1" '.$con_diff1.'>
              I cant concentrate as well as ever.</p>
              <p>&emsp;<input type="radio" name="con_diff" value="2" '.$con_diff2.'>
              Its hard to keep my mind on anything for very long.</p>
              <p>&emsp;<input type="radio" name="con_diff" value="3" '.$con_diff3.'>
              I find I cant concentrate on anything.</p>
              <br>

              <p><b>20. Tiredness or fatigue</b></p>
              <p>&emsp;<input type="radio" name="tired_fati" value="0" '.$tired_fati0.'>
              I am no more tired or fatigued than usual.</p>
              <p>&emsp;<input type="radio" name="tired_fati" value="1" '.$tired_fati1.'>
              I get more tired or fatigued more easily than usual.</p>
              <p>&emsp;<input type="radio" name="tired_fati" value="2" '.$tired_fati2.'>
              I am too tired or fatigued to do a lot of the things I used to do.</p>
              <p>&emsp;<input type="radio" name="tired_fati" value="3" '.$tired_fati3.'>
              I am too tired or fatigued to do most of the things I used to do.</p>
              <br>

              <p><b>21. Loss of Interest in Sex</b></p>
              <p>&emsp;<input type="radio" name="loss_int_sex" value="0" '.$loss_int_sex0.'>
              I Have not noticed any recent change in my interest in sex.</p>
              <p>&emsp;<input type="radio" name="loss_int_sex" value="1" '.$loss_int_sex1.'>
              I am less interested in sex than Iused to be.</p>
              <p>&emsp;<input type="radio" name="loss_int_sex" value="2" '.$loss_int_sex2.'>
              I am much less interested in sex now.</p>
              <p>&emsp;<input type="radio" name="loss_int_sex" value="3" '.$loss_int_sex3.'>
              I have lost interest in sex completely.</p>
              <br>
            </td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="padding-left:380px;">'.$total_score.':Total Score</td>
          </tr>
        </table>

        <br>
        <br>
        <br>
        <br>
        <br>

        <table style="width:100%;">
          <tr>
            <td style="text-align: center;">Scoring the Beck Depression Inventory</td>                        
          </tr>          
        </table>
        <br>
        <table style="width:100%;">
          <tr>
          <td>After you have completed the questionnaire, add up the score for each of the 21 questions.
          The following table indicates the relationship between total score and level of depression
          according to the Beck Depression Inventory.</td>                        
          </tr>
        </table>
        <br>
        <br>
        <br>
        <table style="width: 100%;">
          <tr>
            <td style="border:1px solid black; text-align: center;">Classification</td>
            <td style="border:1px solid black; text-align: center;">Total Score</td>
            <td style="border:1px solid black; text-align: center;">Level of Depression</td>
          </tr>
          <tr>
            <td style="border:1px solid black; text-align: center;" rowspan="2">Low</td>
            <td style="border:1px solid black; text-align: center;">1-10</td>
            <td style="border:1px solid black; text-align: center;">Normal ups and downs</td>
          </tr>
          <tr>
            <td style="border:1px solid black; text-align: center;">11-16</td>
            <td style="border:1px solid black; text-align: center;">Mild mood disturbance</td>
          </tr>
          <tr>
            <td style="border:1px solid black; text-align: center;" rowspan="2">Moderate</td>
            <td style="border:1px solid black; text-align: center;">17-20</td>
            <td style="border:1px solid black; text-align: center;">Borderline clinical depression</td>
          </tr>
          <tr>
            <td style="border:1px solid black; text-align: center;">21-30</td>
            <td style="border:1px solid black; text-align: center;">Moderate depression</td>
          </tr>
          <tr>
            <td style="border:1px solid black; text-align: center;" rowspan="2">Significant</td>
            <td style="border:1px solid black; text-align: center;">31-40</td>
            <td style="border:1px solid black; text-align: center;">Severe depression</td>
          </tr>
          <tr>
            <td style="border:1px solid black; text-align: center;">Over 40</td>
            <td style="border:1px solid black; text-align: center;">Extreme depression</td>
          </tr>
        </table>
        
        ';
    }
    else{
        $print="Not Found";
    }
    // echo $print;
    // exit;
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($print);
$file='pdf/'.time().'.pdf';
$mpdf->Output($file,'I');

?>