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
    $data = sqlQuery("select * from form_beck_anxiety_inventory where id='".$id."'");
    if ($data) 
    {   
        
        if($data['numbness']==0 && $data['numbness']!="")
        { 
          $numbness0 ='checked="checked"';
        }
        if($data['numbness']==1 && $data['numbness']!="")
        { 
          $numbness1 ='checked="checked"';
        }
        if($data['numbness']==2 && $data['numbness']!="")
        { 
          $numbness2 ='checked="checked"';
        }
        if($data['numbness']==3 && $data['numbness']!="")
        { 
          $numbness3 ='checked="checked"';
        }

        if($data['feeling']==0 && $data['feeling']!="")
        { 
          $feeling0 ='checked="checked"';
        }
        if($data['feeling']==1 && $data['feeling']!="")
        { 
          $feeling1 ='checked="checked"';
        }
        if($data['feeling']==2 && $data['feeling']!="")
        { 
          $feeling2 ='checked="checked"';
        }
        if($data['feeling']==3 && $data['feeling']!="")
        { 
          $feeling3 ='checked="checked"';
        }

        if($data['wobbliness']==0 && $data['wobbliness']!="")
        { 
          $wobbliness0 ='checked="checked"';
        }
        if($data['wobbliness']==1 && $data['wobbliness']!="")
        { 
          $wobbliness1 ='checked="checked"';
        }
        if($data['wobbliness']==2 && $data['wobbliness']!="")
        { 
          $wobbliness2 ='checked="checked"';
        }
        if($data['wobbliness']==3 && $data['wobbliness']!="")
        { 
          $wobbliness3 ='checked="checked"';
        }

        if($data['unable']==0 && $data['unable']!="")
        { 
          $unable0 ='checked="checked"';
        }
        if($data['unable']==1 && $data['unable']!="")
        { 
          $unable1 ='checked="checked"';
        }
        if($data['unable']==2 && $data['unable']!="")
        { 
          $unable2 ='checked="checked"';
        }
        if($data['unable']==3 && $data['unable']!="")
        { 
          $unable3 ='checked="checked"';
        }

        if($data['fear']==0 && $data['fear']!="")
        { 
          $fear0 ='checked="checked"';
        }
        if($data['fear']==1 && $data['fear']!="")
        { 
          $fear1 ='checked="checked"';
        }
        if($data['fear']==2 && $data['fear']!="")
        { 
          $fear2 ='checked="checked"';
        }
        if($data['fear']==3 && $data['fear']!="")
        { 
          $fear3 ='checked="checked"';
        }

        if($data['dizzy']==0 && $data['dizzy']!="")
        { 
          $dizzy0 ='checked="checked"';
        }
        if($data['dizzy']==1 && $data['dizzy']!="")
        { 
          $dizzy1 ='checked="checked"';
        }
        if($data['dizzy']==2 && $data['dizzy']!="")
        { 
          $dizzy2 ='checked="checked"';
        }
        if($data['dizzy']==3 && $data['dizzy']!="")
        { 
          $dizzy3 ='checked="checked"';
        }

        if($data['heart']==0 && $data['heart']!="")
        { 
          $heart0 ='checked="checked"';
        }
        if($data['heart']==1 && $data['heart']!="")
        { 
          $heart1 ='checked="checked"';
        }
        if($data['heart']==2 && $data['heart']!="")
        { 
          $heart2 ='checked="checked"';
        }
        if($data['heart']==3 && $data['heart']!="")
        { 
          $heart3 ='checked="checked"';
        }

        if($data['unsteady']==0 && $data['unsteady']!="")
        { 
          $unsteady0 ='checked="checked"';
        }
        if($data['unsteady']==1 && $data['unsteady']!="")
        { 
          $unsteady1 ='checked="checked"';
        }
        if($data['unsteady']==2 && $data['unsteady']!="")
        { 
          $unsteady2 ='checked="checked"';
        }
        if($data['unsteady']==3 && $data['unsteady']!="")
        { 
          $unsteady3 ='checked="checked"';
        }

        if($data['terrified']==0 && $data['terrified']!="")
        { 
          $terrified0 ='checked="checked"';
        }
        if($data['terrified']==1 && $data['terrified']!="")
        { 
          $terrified1 ='checked="checked"';
        }
        if($data['terrified']==2 && $data['terrified']!="")
        { 
          $terrified2 ='checked="checked"';
        }
        if($data['terrified']==3 && $data['terrified']!="")
        { 
          $terrified3 ='checked="checked"';
        }

        if($data['nervous']==0 && $data['nervous']!="")
        { 
          $nervous0 ='checked="checked"';
        }
        if($data['nervous']==1 && $data['nervous']!="")
        { 
          $nervous1 ='checked="checked"';
        }
        if($data['nervous']==2 && $data['nervous']!="")
        { 
          $nervous2 ='checked="checked"';
        }
        if($data['nervous']==3 && $data['nervous']!="")
        { 
          $nervous3 ='checked="checked"';
        }

        if($data['feeling_choking']==0 && $data['feeling_choking']!="")
        { 
          $feeling_choking0 ='checked="checked"';
        }
        if($data['feeling_choking']==1 && $data['feeling_choking']!="")
        { 
          $feeling_choking1 ='checked="checked"';
        }
        if($data['feeling_choking']==2 && $data['feeling_choking']!="")
        { 
          $feeling_choking2 ='checked="checked"';
        }
        if($data['feeling_choking']==3 && $data['feeling_choking']!="")
        { 
          $feeling_choking3 ='checked="checked"';
        }

        if($data['hands_trembling']==0 && $data['hands_trembling']!="")
        { 
          $hands_trembling0 ='checked="checked"';
        }
        if($data['hands_trembling']==1 && $data['hands_trembling']!="")
        { 
          $hands_trembling1 ='checked="checked"';
        }
        if($data['hands_trembling']==2 && $data['hands_trembling']!="")
        { 
          $hands_trembling2 ='checked="checked"';
        }
        if($data['hands_trembling']==3 && $data['hands_trembling']!="")
        { 
          $hands_trembling3 ='checked="checked"';
        }

        if($data['shaky_unsteady']==0 && $data['shaky_unsteady']!="")
        { 
          $shaky_unsteady0 ='checked="checked"';
        }
        if($data['shaky_unsteady']==1 && $data['shaky_unsteady']!="")
        { 
          $shaky_unsteady1 ='checked="checked"';
        }
        if($data['shaky_unsteady']==2 && $data['shaky_unsteady']!="")
        { 
          $shaky_unsteady2 ='checked="checked"';
        }
        if($data['shaky_unsteady']==3 && $data['shaky_unsteady']!="")
        { 
          $shaky_unsteady3 ='checked="checked"';
        }

        if($data['fear_losing_control']==0 && $data['fear_losing_control']!="")
        { 
          $fear_losing_control0 ='checked="checked"';
        }
        if($data['fear_losing_control']==1 && $data['fear_losing_control']!="")
        { 
          $fear_losing_control1 ='checked="checked"';
        }
        if($data['fear_losing_control']==2 && $data['fear_losing_control']!="")
        { 
          $fear_losing_control2 ='checked="checked"';
        }
        if($data['fear_losing_control']==3 && $data['fear_losing_control']!="")
        { 
          $fear_losing_control3 ='checked="checked"';
        }

        if($data['difficulty']==0 && $data['difficulty']!="")
        { 
          $difficulty0 ='checked="checked"';
        }
        if($data['difficulty']==1 && $data['difficulty']!="")
        { 
          $difficulty1 ='checked="checked"';
        }
        if($data['difficulty']==2 && $data['difficulty']!="")
        { 
          $difficulty2 ='checked="checked"';
        }
        if($data['difficulty']==3 && $data['difficulty']!="")
        { 
          $difficulty3 ='checked="checked"';
        }

        if($data['fear_dying']==0 && $data['fear_dying']!="")
        { 
          $fear_dying0 ='checked="checked"';
        }
        if($data['fear_dying']==1 && $data['fear_dying']!="")
        { 
          $fear_dying1 ='checked="checked"';
        }
        if($data['fear_dying']==2 && $data['fear_dying']!="")
        { 
          $fear_dying2 ='checked="checked"';
        }
        if($data['fear_dying']==3 && $data['fear_dying']!="")
        { 
          $fear_dying3 ='checked="checked"';
        }

        if($data['scared']==0 && $data['scared']!="")
        { 
          $scared0 ='checked="checked"';
        }
        if($data['scared']==1 && $data['scared']!="")
        { 
          $scared1 ='checked="checked"';
        }
        if($data['scared']==2 && $data['scared']!="")
        { 
          $scared2 ='checked="checked"';
        }
        if($data['scared']==3 && $data['scared']!="")
        { 
          $scared3 ='checked="checked"';
        }

        if($data['indigestion']==0 && $data['indigestion']!="")
        { 
          $indigestion0 ='checked="checked"';
        }
        if($data['indigestion']==1 && $data['indigestion']!="")
        { 
          $indigestion1 ='checked="checked"';
        }
        if($data['indigestion']==2 && $data['indigestion']!="")
        { 
          $indigestion2 ='checked="checked"';
        }
        if($data['indigestion']==3 && $data['indigestion']!="")
        { 
          $indigestion3 ='checked="checked"';
        }

        if($data['faint']==0 && $data['faint']!="")
        { 
          $faint0 ='checked="checked"';
        }
        if($data['faint']==1 && $data['faint']!="")
        { 
          $faint1 ='checked="checked"';
        }
        if($data['faint']==2 && $data['faint']!="")
        { 
          $faint2 ='checked="checked"';
        }
        if($data['faint']==3 && $data['faint']!="")
        { 
          $faint3 ='checked="checked"';
        }

        if($data['face']==0 && $data['face']!="")
        { 
          $face0 ='checked="checked"';
        }
        if($data['face']==1 && $data['face']!="")
        { 
          $face1 ='checked="checked"';
        }
        if($data['face']==2 && $data['face']!="")
        { 
          $face2 ='checked="checked"';
        }
        if($data['face']==3 && $data['face']!="")
        { 
          $face3 ='checked="checked"';
        }

        if($data['hot_cold']==0 && $data['hot_cold']!="")
        { 
          $hot_cold0 ='checked="checked"';
        }
        if($data['hot_cold']==1 && $data['hot_cold']!="")
        { 
          $hot_cold1 ='checked="checked"';
        }
        if($data['hot_cold']==2 && $data['hot_cold']!="")
        { 
          $hot_cold2 ='checked="checked"';
        }
        if($data['hot_cold']==3 && $data['hot_cold']!="")
        { 
          $hot_cold3 ='checked="checked"';
        }

        $print = '        
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%; text-align:center;">Beck Anxiety Inventory</h4></td>
         </tr>
        </table>
        <br>
        <table>
          <tr>
            <td style="width:25%;">
            <p>Below is a list of common symptoms of anxiety. Please carefully read each item in the list.
              Indicate how much you have been bothered by that symptom during the past month, including
              today, by circling the number in the corresponding space in the column next to each symptom.</p>
            </td>
          </tr>
        </table>
        <br>
        <table style="width:100%; border: 1px solid black;">
          <tr>
            <td style="width:20%; border: 1px solid black;"></td>        
            <td style="width:20%; border: 1px solid black;">Not At All <p style="text-align:center;">0</p></td>        
            <td style="width:20%; border: 1px solid black;">Mildly but it didn’t bother me much.&emsp;&emsp;&emsp; 1</td>        
            <td style="width:20%; border: 1px solid black;">Moderately - it wasn’t pleasant at times &emsp;&emsp;&emsp;&emsp; 2</td>        
            <td style="width:20%; border: 1px solid black;">Severely – it bothered me a lot <p style="text-align:center;">3</p></td>        
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Numbness or tingling</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="numbness" value="0" '.$numbness0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="numbness" value="1" '.$numbness1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="numbness" value="2" '.$numbness2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="numbness" value="3" '.$numbness3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Feeling hot</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling" value="0" '.$feeling0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling" value="1" '.$feeling1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling" value="2" '.$feeling2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling" value="3" '.$feeling3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Wobbliness in legs</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="wobbliness" value="0" '.$wobbliness0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="wobbliness" value="1" '.$wobbliness1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="wobbliness" value="2" '.$wobbliness2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="wobbliness" value="3" '.$wobbliness3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Unable to relax</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unable" value="0" '.$unable0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unable" value="1" '.$unable1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unable" value="2" '.$unable2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unable" value="3" '.$unable3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Fear of worst happening</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear" value="0" '.$fear0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear" value="1" '.$fear1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear" value="2" '.$fear2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear" value="3" '.$fear3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Dizzy or lightheaded</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="dizzy" value="0" '.$dizzy0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="dizzy" value="1" '.$dizzy1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="dizzy" value="2" '.$dizzy2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="dizzy" value="3" '.$dizzy3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Heart pounding/racing</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="heart" value="0" '.$heart0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="heart" value="1" '.$heart1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="heart" value="2" '.$heart2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="heart" value="3" '.$heart3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Unsteady</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unsteady" value="0" '.$unsteady0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unsteady" value="1" '.$unsteady1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unsteady" value="2" '.$unsteady2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="unsteady" value="3" '.$unsteady3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Terrified or afraid</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="terrified" value="0" '.$terrified0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="terrified" value="1" '.$terrified1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="terrified" value="2" '.$terrified2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="terrified" value="3" '.$terrified3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Nervous</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="nervous" value="0" '.$narvous0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="nervous" value="1" '.$narvous1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="nervous" value="2" '.$narvous2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="nervous" value="3" '.$narvous3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Feeling of choking</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling_choking" value="0" '.$feeling_choking0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling_choking" value="1" '.$feeling_choking1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling_choking" value="2" '.$feeling_choking2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="feeling_choking" value="3" '.$feeling_choking3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Handstrembling</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hands_trembling" value="0" '.$hands_trembling0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hands_trembling" value="1" '.$hands_trembling1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hands_trembling" value="2" '.$hands_trembling2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hands_trembling" value="3" '.$hands_trembling3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Shaky / unsteady</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="shaky_unsteady	" value="0" '.$shaky_unsteady0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="shaky_unsteady	" value="1" '.$shaky_unsteady1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="shaky_unsteady	" value="2" '.$shaky_unsteady2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="shaky_unsteady	" value="3" '.$shaky_unsteady3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Fear of losing control</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_losing_control" value="0" '.$fear_losing_control0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_losing_control" value="1" '.$fear_losing_control1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_losing_control" value="2" '.$fear_losing_control2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_losing_control" value="3" '.$fear_losing_control3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Difficulty in breathing</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="difficulty" value="0" '.$difficulty0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="difficulty" value="1" '.$difficulty1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="difficulty" value="2" '.$difficulty2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="difficulty" value="3" '.$difficulty3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Fear of dying</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_dying" value="0" '.$fear_dying0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_dying" value="1" '.$fear_dying1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_dying" value="2" '.$fear_dying2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="fear_dying" value="3" '.$fear_dying3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Scared</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="scared" value="0" '.$scared0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="scared" value="1" '.$scared1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="scared" value="2" '.$scared2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="scared" value="3" '.$scared3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Indigestion</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="indigestion" value="0" '.$indigestion0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="indigestion" value="1" '.$indigestion1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="indigestion" value="2" '.$indigestion2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="indigestion" value="3" '.$indigestion3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Faint / lightheaded</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="faint" value="0" '.$faint0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="faint" value="1" '.$faint1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="faint" value="2" '.$faint2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="faint" value="3" '.$faint3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Face flushed</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="face" value="0" '.$face0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="face" value="1" '.$face1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="face" value="2" '.$face2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="face" value="3" '.$face3.'></td>           
          </tr>
          <tr>
            <td style="width:20%; border: 1px solid black;">Hot/cold sweats</td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hot_cold" value="0" '.$hot_cold0.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hot_cold" value="1" '.$hot_cold1.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hot_cold" value="2" '.$hot_cold2.'></td>        
            <td style="width:20%; border: 1px solid black; text-align:center; padding-top:10px; padding-bottom:10px;"><input type="radio" name="hot_cold" value="3" '.$hot_cold3.'></td>           
          </tr>
        </table>
        <p><b>Scoring</b> - Sum each column. Then sum the column totals to achieve a grand score.</p>
        <table style="width:100%;">
          <tr>
            <td>Write grand score here: <b>'.$data['grand_score'].'</b></td>
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