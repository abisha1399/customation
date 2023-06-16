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
    $data = sqlQuery("select * from form_biopsychosocial_evaluation where id='".$id."'");
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

        if($data['hispanic1']=='yes' && $data['hispanic1']!="")
        { 
          $hispanic1 ='checked="checked"';
        }
        if($data['hispanic2']=='no' && $data['hispanic2']!="")
        { 
          $hispanic2 ='checked="checked"';
        }

        if($data['same_address1']=='yes' && $data['same_address1']!="")
        { 
          $same_address1 ='checked="checked"';
        }
        if($data['same_address2']=='no' && $data['same_address2']!="")
        { 
          $same_address2 ='checked="checked"';
        }

        if($data['satisfied1']=='yes' && $data['satisfied1']!="")
        { 
          $satisfied1 ='checked="checked"';
        }
        if($data['satisfied2']=='no' && $data['satisfied2']!="")
        { 
          $satisfied2 ='checked="checked"';
        }
        if($data['satisfied3']=='indifferent' && $data['satisfied3']!="")
        { 
          $satisfied3 ='checked="checked"';
        }

        if($data['satisfied4']=='yes' && $data['satisfied4']!="")
        { 
          $satisfied4 ='checked="checked"';
        }
        if($data['satisfied5']=='no' && $data['satisfied5']!="")
        { 
          $satisfied5 ='checked="checked"';
        }
        if($data['satisfied6']=='indifferent' && $data['satisfied6']!="")
        { 
          $satisfied6 ='checked="checked"';
        }

        if($data['veteran1']=='yes' && $data['veteran1']!="")
        { 
          $veteran1 ='checked="checked"';
        }
        if($data['veteran2']=='no' && $data['veteran2']!="")
        { 
          $veteran2 ='checked="checked"';
        }

        if($data['car_avai1']=='yes' && $data['car_avai1']!="")
        { 
          $car_avai1 ='checked="checked"';
        }
        if($data['car_avai2']=='no' && $data['car_avai2']!="")
        { 
          $car_avai2 ='checked="checked"';
        }

        if($data['family']=='family' && $data['family']!="")
        { 
          $family ='checked="checked"';
        }
        if($data['work']=='work' && $data['work']!="")
        { 
          $work ='checked="checked"';
        }
        if($data['legal']=='legal' && $data['legal']!="")
        { 
          $legal ='checked="checked"';
        }
        if($data['self']=='self' && $data['self']!="")
        { 
          $self ='checked="checked"';
        }

        if($data['chronic_medical_issues']=='yes' && $data['chronic_medical_issues']!="")
        { 
          $chronic_medical_issues ='checked="checked"';
        }
        if($data['chronic_medical_issues1']=='no' && $data['chronic_medical_issues1']!="")
        { 
          $chronic_medical_issues1 ='checked="checked"';
        }
        
        if($data['none']=='None' && $data['none']!="")
        { 
          $none ='checked="checked"';
        }
        if($data['heart_disease']=='Heart Disease' && $data['heart_disease']!="")
        { 
          $heart_disease ='checked="checked"';
        }
        if($data['liver_problems']=='Liver problems' && $data['liver_problems']!="")
        { 
          $liver_problems ='checked="checked"';
        }
        if($data['asthma']=='Asthma' && $data['asthma']!="")
        { 
          $asthma ='checked="checked"';
        }
        if($data['std']=='STD' && $data['std']!="")
        { 
          $std ='checked="checked"';
        }
        if($data['high_cholesterol']=='High Cholesterol' && $data['high_cholesterol']!="")
        { 
          $high_cholesterol ='checked="checked"';
        }
        if($data['head_trauma']=='Head Trauma' && $data['head_trauma']!="")
        { 
          $head_trauma ='checked="checked"';
        }
        if($data['lung_problems']=='Lung problems' && $data['lung_problems']!="")
        { 
          $lung_problems ='checked="checked"';
        }
        if($data['hiv_aids']=='HIV/AIDS' && $data['hiv_aids']!="")
        { 
          $hiv_aids ='checked="checked"';
        }
        if($data['diabetes_type']=='Diabetes: type I or II' && $data['diabetes_type']!="")
        { 
          $diabetes_type ='checked="checked"';
        }
        if($data['hypertension']=='hypertension' && $data['hypertension']!="")
        { 
          $hypertension ='checked="checked"';
        }
        if($data['kidney_problems']=='kidney problems' && $data['kidney_problems']!="")
        { 
          $kidney_problems ='checked="checked"';
        }
        if($data['hepatitis']=='hepatitis' && $data['hepatitis']!="")
        { 
          $hepatitis ='checked="checked"';
        }
        if($data['a']=='a' && $data['a']!="")
        { 
          $a ='checked="checked"';
        }
        if($data['b']=='b' && $data['b']!="")
        { 
          $b ='checked="checked"';
        }
        if($data['c']=='c' && $data['c']!="")
        { 
          $c ='checked="checked"';
        }

        if($data['prescription_medication']=='yes' && $data['prescription_medication']!="")
        { 
          $prescription_medication ='checked="checked"';
        }
        if($data['prescription_medication1']=='no' && $data['prescription_medication1']!="")
        { 
          $prescription_medication1 ='checked="checked"';
        }

        if($data['physical_problem']=='yes' && $data['physical_problem']!="")
        { 
          $physical_problem ='checked="checked"';
        }
        if($data['physical_problem1']=='no' && $data['physical_problem1']!="")
        { 
          $physical_problem1 ='checked="checked"';
        }

        if($data['medication']=='yes' && $data['medication']!="")
        { 
          $medication ='checked="checked"';
        }
        if($data['medication1']=='no' && $data['medication1']!="")
        { 
          $medication1 ='checked="checked"';
        }

        if($data['disability']=='yes' && $data['disability']!="")
        { 
          $disability ='checked="checked"';
        }
        if($data['disability1']=='no' && $data['disability1']!="")
        { 
          $disability1 ='checked="checked"';
        }
        

        $print = '        
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%; text-align:center;">Biopsychosocial Evaluation</h4></td>
         </tr>
        </table>
        <br>

        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Client Name: '.$data['cname'].' </td>                
            <td style="width:50%;">Date of Evaluation: '.$data['date_eval'].'</td>                
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:10%;">Age: </td>                
            <td style="width:20%;">Sex: <input type="checkbox" name="sex" value="male" '.$male.'>Male<input type="checkbox" name="sex" value="female" '.$female.'>Female</td>                
            <td style="width:10%;">Height: </td> 
            <td style="width:10%;">Weight: </td> 
            <td style="width:10%;">Race: </td> 
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>                      
            <td style="width:30%;">Hispanic: <input type="checkbox" name="hispanic1" value="yes" '.$hispanic1.'>Yes<input type="checkbox" name="hispanic2" value="no" '.$hispanic2.'2>No</td>                
            <td style="width:70%;">If yes, specify: '.$data['specify1'].'</td>      
          </tr>
        </table>  
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Address: '.$data['address'].'</td>                
            <td style="width:25%;">Zip Code: '.$data['zipcode'].'</td>                
            <td style="width:25%;">County: '.$data['country'].'</td>                
          </tr>
        </table> 
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:100%;">Client Phone Number: '.$data['phone_num'].'</td>               
          </tr>
        </table> 
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Collateral Contact: '.$data['collateral_contact'].'</td>                
            <td style="width:50%;">Relationship: '.$data['relationship1'].'</td>                
          </tr>
        </table> 
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Emergency contact 01: '.$data['emergency_contact1'].'</td>                
            <td style="width:50%;">Relationship: '.$data['relationship2'].'</td>                
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Emergency contact 02: '.$data['emergency_contact2'].'</td>                
            <td style="width:50%;">Relationship: '.$data['relationship3'].'</td>                
          </tr>
        </table> 
        <br>
        <table style="width:100%;">
          <tr>                      
            <td style="width:30%;">Same Address: <input type="checkbox" name="same_address1" value="yes" '.$same_address1.'>Yes<input type="checkbox" name="same_address2" value="no" '.$same_address2.'>No</td>                
            <td style="width:50%;">If yes, address: '.$data['address1'].'</td>      
            <td style="width:20%;">Country: '.$data['country1'].'</td>      
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:50%;">Living Arrangements: '.$data['living_arrangements'].'</td>                
            <td style="width:25%;">How Long: '.$data['how_long1'].'</td>                
            <td style="width:25%;">Referral: '.$data['referral'].'</td>                
          </tr>
        </table>  
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:10%;">SSN: '.$data['ssn'].'</td>                
            <td style="width:20%;">Marital Status: '.$data['marital_status'].'</td>                
            <td style="width:15%;">How Long: '.$data['how_long2'].'</td>    
            <td style="width:55%;">Are you satisfied? <input type="checkbox" name="satisfied1" value="yes" '.$satisfied1.'>Yes<input type="checkbox" name="satisfied2" value="no" '.$satisfied2.'>No<input type="checkbox" name="satisfied3" value="indifferent" '.$satisfied3.'>Indifferent</td>            
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:20%;">Occupation: '.$data['occupation'].'</td>             
            <td style="width:25%;">How Long: '.$data['how_long3'].'</td>    
            <td style="width:55%;">Are you satisfied? <input  type="checkbox" name="satisfied4" value="yes" '.$satisfied4.'>Yes<input type="checkbox" name="satisfied5" value="no" '.$satisfied5.'>No<input type="checkbox" name="satisfied6" value="indifferent" '.$satisfied6.'>Indifferent</td>            
          </tr>
        </table> 
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:100%;">Monthly Income: '.$data['monthly_income'].'</td>               
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Are you a Veteran? <input  type="checkbox" name="veteran1" value="yes" '.$veteran1.'>Yes<input type="checkbox" name="veteran2" value="no" '.$veteran2.'>No</td>               
          </tr>
        </table> 
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:60%;">Occupation: '.$data['occupation1'].'</td>       
            <td style="width:40%;">car available? <input  type="checkbox" name="car_avai1" value="yes" '.$car_avai1.'>Yes<input type="checkbox" name="car_avai2" value="no" '.$car_avai2.'>No</td>            
          </tr>
        </table>  
        <br>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Do you have any spiritual beliefs? (Religion, prayer, belief in God(s)/Higher Power, sources of comfort)
           '.$data['spiritual_beliefs'].'</td>               
          </tr>
        </table>
        <br>
        <br> 
        
        <p style="text-decoration: underline;">PRESENTING ISSUES</p>
        <br>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Substance Abuse: '.$data['substance_abuse'].'</td>               
          </tr>
          <tr>
          <td style="width:40%;">Mental Health: '.$data['mental_health'].'</td>               
          </tr>
        </table>
        <br>
        <table>
          <tr>
          <td style="width:40%;">Reason for seeking treatment at this point: '.$data['treatment_point'].'</td>               
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Are you seeking treatment because of pressure from: <input  type="checkbox" name="date_eval" value="family" '.$family.'> Family <input type="checkbox" name="date_eval" value="work" '.$work.'> Work <input type="checkbox" name="date_eval" value="legal" '.$legal.'> Legal <input type="checkbox" name="date_eval" value="self" '.$self.'> self</td>               
          </tr>
        </table>
        <br>
        <p ><span style="text-decoration: underline;">PRESENTING ISSUES</span> (Presenting issues)</p>
        <table style="width:100%;">
          <tr>
          <td style="width:40%;">Do you have any chronic medical issues that interfere with your life? <input  type="checkbox" name="date_eval" value=""> Yes <input type="checkbox" name="date_eval" value=""> No</td>               
          </tr>
        </table>
        <br>
        <table  style="width:100%;">
          <tr>
            <td style="width: 40%;">Allergies: (Medication/Food)</td>
            <td style="width: 60%;"><input type="checkbox" name="date_eval" value="">NKDA</td>
          </tr>
        </table>

        <table style="width:100%;">
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="none" value="None" '.$none.'>None</td>
            <td style="width: 20%;"><input type="checkbox" name="heart_disease" value="Heart Disease" '.$heart_disease.'>Heart Disease</td>
            <td style="width: 20%;"><input type="checkbox" name="liver_problems" value="Liver problems" '.$liver_problems.'>Liver problems</td>
            <td style="width: 20%;"><input type="checkbox" name="asthma" value="Asthma" '.$asthma.'>Asthma</td>
            <td style="width: 20%;"><input type="checkbox" name="std" value="STD" '.$std.'>STD</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="high_cholesterol" value="High Cholesterol" '.$high_cholesterol.'>High Cholesterol</td>
            <td style="width: 20%;"><input type="checkbox" name="head_trauma" value="Head Trauma" '.$head_trauma.'>Head Trauma</td>
            <td style="width: 20%;"><input type="checkbox" name="lung_problems" value="Lung problems" '.$lung_problems.'>Lung problems</td>
            <td style="width: 20%;" rowspan="2"><input type="checkbox" name="hiv_aids" value="HIV/AIDS" '.$hiv_aids.'>HIV/AIDS</td>
          </tr>
        </table>

        <table style="width:100%;">
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="diabetes_type" value="Diabetes: type I or II" '.$diabetes_type.'>Diabetes: type I or II</td>
            <td style="width: 20%;"><input type="checkbox" name="hypertension" value="Hypertension" '.$hypertension.'>Hypertension</td>
            <td style="width: 20%;"><input type="checkbox" name="kidney_problems" value="Kidney problems" '.$kidney_problems.' >Kidney problems</td>
            <td style="width: 20%;"><input type="checkbox" name="hepatitis" value="Hepatitis" '.$hepatitis.'>Hepatitis</td>
            <td><input type="checkbox" name="a" value="A" '.$a.'>A<input type="checkbox" name="b" value="B" '.$b.'>B<input type="checkbox" name="c" value="C" '.$c.'>C</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Other:</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Hospitalizations in lifetime (physical) <input type="checkbox" name="date_eval" value=""> Yes <input type="checkbox" name="date_eval" value=""> No</td>
          </tr>
          <tr>
            <td>If yes, explain: '.$data['explain1'].'</td>
          </tr>
          <tr>
            <td>Last hospitalization: '.$data['spiritual_beliefs'].' </td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Current Medications (including for substance abuse): '.$data['spiritual_beliefsspiritual_beliefs'].'</td>
          </tr>
          <tr>
            <td>Are you following your doctor’s instructions closely on prescription medication use? <input type="checkbox" name="prescription_medication" value="yes" '.$prescription_medication.'> Yes <input type="checkbox" name="prescription_medication1" value="no" '.$prescription_medication1.'> No</td>
          </tr>
          <tr>
            <td>Are you taking any prescribed medication on regular basis for a physical problem? <input type="checkbox" name="physical_problem" value="yes" '.$physical_problem.'> Yes <input type="checkbox" name="physical_problem1" value="" '.$physical_problem1.'> No</td>
          </tr>
          <tr>
            <td>Do you comply with your medication? <input type="checkbox" name="medication" value="yes" '.$medication.'> Yes <input type="checkbox" name="medication1" value="no" '.$medication1.'> No</td>
            <td>Do you receive pension for disability? <input type="checkbox" name="disability" value="yes" '.$disability.'> Yes <input type="checkbox" name="disability1" value="no" '.$disability1.'> No</td>
          </tr>
        </table>
        <br>
        <table styel="width:100%">
          <tr>
            <td>How bothered are you by your medical condition? Not at all '.$data['medical_condition'].'</td>
          </tr>
          <tr>
            <td>How important is treatment to you for your medical condition? Not at all '.$data['medical_condition1'].'</td>
          </tr>
        </table>
        <br>
        <p style="text-align: center; text-decoration: underline;">SUBSTANCE USE HISTORY</p>
        <table style="width: 100%;">
          <tr>
            <td style="border: 1px solid black;">Substances</td>
            <td style="border: 1px solid black;">Route of admin</td>
            <td style="border: 1px solid black;">First Use (age)</td>
            <td style="border: 1px solid black;">Last Use</td>
            <td style="border: 1px solid black;">Comments</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Tobacco</td>
            <td style="border: 1px solid black;">'.$data['tabacco1'].'</td>
            <td style="border: 1px solid black;">'.$data['tabacco2'].'</td>
            <td style="border: 1px solid black;">'.$data['tabacco3'].'</td>
            <td style="border: 1px solid black;">'.$data['tabacco4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Alcohol</td>
            <td style="border: 1px solid black;">'.$data['alcohol1'].'</td>
            <td style="border: 1px solid black;">'.$data['alcohol2'].'</td>
            <td style="border: 1px solid black;">'.$data['alcohol3'].'</td>
            <td style="border: 1px solid black;">'.$data['alcohol4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Cannabis</td>
            <td style="border: 1px solid black;">'.$data['cannabis1'].'</td>
            <td style="border: 1px solid black;">'.$data['cannabis2'].'</td>
            <td style="border: 1px solid black;">'.$data['cannabis3'].'</td>
            <td style="border: 1px solid black;">'.$data['cannabis4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Cocaine</td>
            <td style="border: 1px solid black;">'.$data['cocaine1'].'</td>
            <td style="border: 1px solid black;">'.$data['cocaine2'].'</td>
            <td style="border: 1px solid black;">'.$data['cocaine3'].'</td>
            <td style="border: 1px solid black;">'.$data['cocaine4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Heroin</td>
            <td style="border: 1px solid black;">'.$data['heroin1'].'</td>
            <td style="border: 1px solid black;">'.$data['heroin2'].'</td>
            <td style="border: 1px solid black;">'.$data['heroin3'].'</td>
            <td style="border: 1px solid black;">'.$data['heroin4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Other opiates:</td>
            <td style="border: 1px solid black;">'.$data['other_opiates1'].'</td>
            <td style="border: 1px solid black;">'.$data['other_opiates2'].'</td>
            <td style="border: 1px solid black;">'.$data['other_opiates3'].'</td>
            <td style="border: 1px solid black;">'.$data['other_opiates4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Methadone</td>
            <td style="border: 1px solid black;">'.$data['methadone1'].'</td>
            <td style="border: 1px solid black;">'.$data['methadone2'].'</td>
            <td style="border: 1px solid black;">'.$data['methadone3'].'</td>
            <td style="border: 1px solid black;">'.$data['methadone4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Amphetamines</td>
            <td style="border: 1px solid black;">'.$data['amphetamines1'].'</td>
            <td style="border: 1px solid black;">'.$data['amphetamines2'].'</td>
            <td style="border: 1px solid black;">'.$data['amphetamines3'].'</td>
            <td style="border: 1px solid black;">'.$data['amphetamines4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Benzodiazepines</td>
            <td style="border: 1px solid black;">'.$data['benzodiazepines1'].'</td>
            <td style="border: 1px solid black;">'.$data['benzodiazepine2'].'</td>
            <td style="border: 1px solid black;">'.$data['benzodiazepine3'].'</td>
            <td style="border: 1px solid black;">'.$data['benzodiazepine4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">LSD/Psilocybin/K/PCP</td>
            <td style="border: 1px solid black;">'.$data['lsd_pcp1'].'</td>
            <td style="border: 1px solid black;">'.$data['lsd_pcp2'].'</td>
            <td style="border: 1px solid black;">'.$data['lsd_pcp3'].'</td>
            <td style="border: 1px solid black;">'.$data['lsd_pcp4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Inhalants</td>
            <td style="border: 1px solid black;">'.$data['inhalants1'].'</td>
            <td style="border: 1px solid black;">'.$data['inhalants2'].'</td>
            <td style="border: 1px solid black;">'.$data['inhalants3'].'</td>
            <td style="border: 1px solid black;">'.$data['inhalants4'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black; height: 100px;">Others</td>
            <td style="border: 1px solid black;">'.$data['other1'].'</td>
            <td style="border: 1px solid black;">'.$data['other2'].'</td>
            <td style="border: 1px solid black;">'.$data['other3'].'</td>
            <td style="border: 1px solid black;">'.$data['other4'].'</td>
          </tr>
          <tr>
            <td>Additional Notes: '.$data['additional_notes'].'</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td> OD’s/DT’s in lifetime: '.$data['od_dt'].'</td>
          </tr>
          <tr>
            <td> Drug use in the last 30 days: '.$data['odurg'].'</td>
          </tr>
          <tr>
            <td> Money spent in the past 30 days on: Alcohol: '.$data['money_spent_alcohol'].'  Drugs: '.$data['money_spent_drugs'].'</td>
          </tr>
        </table>
        <br>
        <p><span style="text-decoration: underline;">SUBSTANCE ABUSE RELATED WITHDRAWAL SYMPTOMS</span> (check all that apply)</p>
        <table style="width:100%;">
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Denies</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Vomiting</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Constipation</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Irritability</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Problems sleeping</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Cravings</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Change in appetite</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Stomach cramps</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Feeling sad</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Fatigue</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Nausea</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Diarrhea</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Anxiety(hx)</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Fearful</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Difficulty concentrating</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Restless leg</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Restlessness</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Tremors</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Dizziness</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Headaches</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Muscle aches</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Muscle stiffness</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Weakness</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Numbness</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Hot/cold temperate changes</td>
          </tr>
          <tr>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Sweats</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Heart pounding</td>
            <td style="width: 20%;" rowspan="2"><input type="checkbox" name="date_eval" value="">Auditory/Visual/Tactile Hallucinations</td>
            <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Insomnia</td>
          </tr>
          <tr>
          <td style="width: 20%;"><input type="checkbox" name="date_eval" value="">Other:</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Any history of drug/alcohol related seizures? <input type="checkbox" name="date_eval" value=""> Yes <input type="checkbox" name="date_eval" value=""> No</td>
          </tr>
          <tr>
            <td>If yes, when: '.$data['yes_when'].'</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Sleep changes:&emsp;&emsp; <input type="checkbox" name="date_eval" value=""> No change &emsp;&emsp;<input type="checkbox" name="date_eval" value=""> Interrupted &emsp;&emsp;<input type="checkbox" name="date_eval" value=""> Increased &emsp;&emsp;<input type="checkbox" name="date_eval" value=""> Decreased</td>
          </tr>
          <tr>
            <td>Explain: '.$data['explain2'].'</td>
          </tr>          
        </table>

        <br>
        <table style="width:100%;">
          <tr>
            <td>Appetite changes:&emsp;&emsp; <input type="checkbox" name="date_eval" value=""> Increased &emsp;&emsp;<input type="checkbox" name="date_eval" value=""> Decreased &emsp;&emsp;<input type="checkbox" name="date_eval" value=""> No change &emsp;&emsp;<input type="checkbox" name="date_eval" value=""> Weight loss &emsp;&emsp;<input type="checkbox" name="date_eval" value=""> Weight gain</td>
          </tr>
          <tr>
            <td>Explain: '.$data['explain3'].'</td>
          </tr>          
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Cravings:&emsp;&emsp; <input type="checkbox" name="date_eval" value=""> Absent &emsp;&emsp;<input type="checkbox" name="date_eval" value=""> Present:<input type="checkbox" name="date_eval" value="">Mild,<input type="checkbox" name="date_eval" value=""> Moderate, <input type="checkbox" name="date_eval" value=""> Severe</td>
          </tr>
          <tr>
            <td>Urges: <input type="checkbox" name="date_eval" value="">None &emsp;&emsp; <input type="checkbox" name="date_eval" value="">Present,how often:</td>
          </tr>          
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Substance Abuse Related Symptoms and Observations</td>
          </tr>
          <tr>
            <td style="font-style: italic;">Evidence of increased tolerance to substance use:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value=""> Need to increase quantity to get desired effect</td>
            <td><input type="checkbox" name="date_eval" value=""> Increased number of use episodes</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Repeated efforts to reduce usage</td>
            <td><input type="checkbox" name="date_eval" value="">Continuous use of at least 2 day duration</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Blackouts</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td><span style="text-decoration: underline;">Reason for Substance Use</span> (check off relevant ones): </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Euphoria &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Fear &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Anger &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Insomnia &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Stress &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Social Discomfort &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Peer Pressure</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value=""> Other: </td>
          </tr>
          <tr>
            <td>Substance Use/Abuse Circumstances: '.$data['use_abuse_circumstances'].'</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Behavior While Using Substances</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Extroverted &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Isolated &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Aggressive &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Promiscuous</td>
          </tr>
          <tr>
            <td>Explain: '.$data['explain4'].'</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="text-decoration:underline;">Personality/Behavioral Changes Related to Substance Use:</td>
          </tr>
          <tr>
            <td style="width:50%; text-decoration:underline;">Personality</td>
            <td style="width:50%; text-decoration:underline;">Behavioral</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Increased moodiness</td>
            <td><input type="checkbox" name="date_eval" value="">Preoccupation with substance supply</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Jumpy, nervous</td>
            <td><input type="checkbox" name="date_eval" value="">Secretive use</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Irritable</td>
            <td><input type="checkbox" name="date_eval" value="">Use at unusual times</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Paranoid</td>
            <td><input type="checkbox" name="date_eval" value="">Urgent use</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Low self-confidence</td>
            <td><input type="checkbox" name="date_eval" value="">Loss of interest in social/recreational activates</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Depressed</td>
            <td><input type="checkbox" name="date_eval" value="">Homicidal/suicidal urges while using</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Withdrawn</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Loss of energy</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Anger</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Has substance abuse resulted in: '.$data['substance_result'].'</td>
          </tr>
          <tr>
            <td>Poor judgement: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Yes,explain: '.$data['inhalants4'].'&emsp;&emsp;<input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>Cognitive impairments: &emsp;<input type="checkbox" name="date_eval" value="">Denies</td>
          </tr>
          <tr>
            <td> &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Loss of memory recent or remote</td>
            <td> <input type="checkbox" name="date_eval" value="">Vision changes (double vision, drooping eyelids)</td>
          </tr>
          <tr>
            <td> &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Loss of muscle control</td>
            <td> <input type="checkbox" name="date_eval" value="">Nystagmus (involuntary eye movements)</td>
          </tr>
          <tr>
            <td> &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Inability to concentrate</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>History of previous treatment (Substance Abuse)</td>
          </tr>
          <tr>
            <td>Substance abuse (most recent first), reason for treatment, facility, when, treatment length, outcome:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Client denies previous history of treatment</td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="border: 1px solid black; text-align: center;">Facility Name</td>
            <td style="border: 1px solid black; text-align: center;">When</td>
            <td style="border: 1px solid black; text-align: center;">Length of treatment</td>
            <td style="border: 1px solid black; text-align: center;">Completed?Y/N</td>
            <td style="border: 1px solid black; text-align: center;">Outcome:</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;">'.$data['facility_name1'].'</td>
            <td style="border: 1px solid black;">'.$data['when1'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_treatment1'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_completed1'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_outcome1'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;">'.$data['facility_name2'].'</td>
            <td style="border: 1px solid black;">'.$data['when2'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_treatment2'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_completed2'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_outcome2'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;">'.$data['facility_name3'].'</td>
            <td style="border: 1px solid black;">'.$data['when3'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_treatment3'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_completed3'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_outcome3'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;">'.$data['facility_name4'].'</td>
            <td style="border: 1px solid black;">'.$data['when4'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_treatment4'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_completed4'].'</td>
            <td style="border: 1px solid black;">'.$data['facility_outcome4'].'</td>
          </tr>     
          <tr>
            <td>How many were detoxes only: '.$data['facility_detoxes'].' </td>
          </tr>                     
        </table>
          <p> Longest period of voluntary abstinence (when and how it was achieved): '.$data['facility_voluntary'].'</p>
        <br>
        <table>
          <tr>
            <td>Last period of abstinence: '.$data['abstinence1'].'</td>
            <td>When last period of abstinence ended: '.$data['abstinence2'].'</td>            
          </tr>
          <tr>
            <td><br>Self-help groups attended: '.$data['attended'].'</td>
            <td><br>Since: '.$data['since'].'</td>
            <td><br>Times/week: '.$data['timw_week'].'</td>
          </tr>
          <tr>
            <td>Do/did you have a sponsor? '.$data['sponsor'].'</td>
            <td>Attendance in last 30 days: '.$data['attendance'].'</td>
          </tr>
          <tr>
            <td>What do you think of self-help groups? '.$data['self_help_groups'].'</td>
          </tr>
        </table>
        <table>
          <tr>
            <td>How bothered are you by your substance use? Not at all '.$data['self_bothered'].'</td>
          </tr>
          <tr>
            <td>How important to you is treatment for your substance use? Not at all '.$data['self_important_treatment'].'</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td style="text-decoration: underline;">Co-Occurring Mental Illness</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Denies &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Present</td>
          </tr>
          <tr>
            <td>If yes, specify diagnosis: '.$data['diagnosis'].'</td>
          </tr>
          <tr>
            <td>When were you first diagnosed? '.$data['diagnosed'].'</td>
          </tr>
          <tr>
            <td><br>Mental health treatment &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Denies</td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="border: 1px solid black; text-align: center;">Most recent treatmentfacility</td>
            <td style="border: 1px solid black; text-align: center;">Year</td>
            <td style="border: 1px solid black; text-align: center;">Reason fortreatment</td>
            <td style="border: 1px solid black; text-align: center;">Type offacility</td>
            <td style="border: 1px solid black; text-align: center;">Treatmentlength</td>
            <td style="border: 1px solid black; text-align: center;">Outcome:</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;">'.$data['treatmentfacility1'].'</td>
            <td style="border: 1px solid black;">'.$data['year1'].'</td>
            <td style="border: 1px solid black;">'.$data['reason_fortreatment1'].'</td>
            <td style="border: 1px solid black;">'.$data['type_offacility1'].'</td>
            <td style="border: 1px solid black;">'.$data['treatmentlength1'].'</td>
            <td style="border: 1px solid black;">'.$data['outcome1'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;">'.$data['treatmentfacility2'].'</td>
            <td style="border: 1px solid black;">'.$data['year2'].'</td>
            <td style="border: 1px solid black;">'.$data['reason_fortreatment2'].'</td>
            <td style="border: 1px solid black;">'.$data['type_offacility2'].'</td>
            <td style="border: 1px solid black;">'.$data['treatmentlength2'].'</td>
            <td style="border: 1px solid black;">'.$data['outcome2'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;">'.$data['treatmentfacility3'].'</td>
            <td style="border: 1px solid black;">'.$data['year3'].'</td>
            <td style="border: 1px solid black;">'.$data['reason_fortreatment3'].'</td>
            <td style="border: 1px solid black;">'.$data['type_offacility3'].'</td>
            <td style="border: 1px solid black;">'.$data['treatmentlength3'].'</td>
            <td style="border: 1px solid black;">'.$data['outcome3'].'</td>
          </tr>
          <tr>
            <td style="border: 1px solid black;">'.$data['treatmentfacility4'].'</td>
            <td style="border: 1px solid black;">'.$data['year4'].'</td>
            <td style="border: 1px solid black;">'.$data['reason_fortreatment4'].'</td>
            <td style="border: 1px solid black;">'.$data['type_offacility4'].'</td>
            <td style="border: 1px solid black;">'.$data['treatmentlength4'].'</td>
            <td style="border: 1px solid black;">'.$data['outcome4'].'</td>
          </tr>     
          <tr>
            <td><br><input type="checkbox" name="date_eval" value="">Bullied by others</td>
          </tr> 
        </table>
        <table>         
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Have you ever practiced the behavior of bullying or been accused of bullying by others? Explain:</td>
          </tr>           
        </table>     
        <br>
        <table>
          <tr>
            <td>Eating Disorders: Past diagnosis: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Denies &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Present: <input type="checkbox" name="date_eval" value="">Purging <input type="checkbox" name="date_eval" value="">Binge Eating <input type="checkbox" name="date_eval" value="">Anorexia <input type="checkbox" name="date_eval" value="">Bulimia</td>
          </tr>
          <tr>
            <td>Frequency:'.$data['frequency1'].' Age of onset: '.$data['frequency2'].' Lasted until: '.$data['frequency3'].'</td>
          </tr>
          <tr>
            <td>Limiting food intake: '.$data['frequency4'].' Age of onset: '.$data['frequency5'].' Lasted until: '.$data['frequency6'].'</td>
          </tr>
          <tr>
            <td><br>Self-Mutilation/Cutting Behaviors: &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Yes &emsp;&emsp;<input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>If yes, <input type="checkbox" name="date_eval" value="">Cutting <input type="checkbox" name="date_eval" value="">Burning <input type="checkbox" name="date_eval" value="">Hair pulling <input type="checkbox" name="date_eval" value="">Piercings <input type="checkbox" name="date_eval" value="">Tattoos</td>
          </tr>
          <tr>
            <td>Age of onset: '.$data['age_onset'].' Frequency: '.$data['frequency'].' Area on the body: Lasted until: '.$data['lasted_until'].' </td>
          </tr>  

          <tr>
            <td><br>Gambling behaviors:</td>
          </tr>
          <tr>
            <td>Did/do you gamble (online/in person)? <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">Yes, how often?</td>
          </tr>
          <tr>
            <td>Explain: '.$data['explain7'].'</td>
          </tr>
          <tr>
            <td>Have you spent a lot of time thinking about past gambling experience or planning future gambling ventures or bets? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>Have you ever lied to family members, friends or others about how often you gamble or how much money you lost gambling? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>After losing do you try to return as quickly as possible to win back your losses? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>LETHAILITY ASSESSMENT</td>
          </tr>
          <tr>
            <td>Do you have access to any firearms? <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">Yes</td>
          </tr>
          <tr>
            <td>Do you own guns or other weapons? <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">Yes &emsp;&emsp;&emsp;&emsp;&emsp; If yes, what kind? '.$data['lethaility_assessment5'].'</td>
          </tr>
          <tr>
            <td>If you own a gun, do you have a gun permit? <input type="checkbox" name="date_eval" value="">N/A <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">Yes &emsp;&emsp;&emsp;&emsp;&emsp;  Do you have ammunition? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>Is the gun and ammunition in a secured place? <input type="checkbox" name="date_eval" value="">N/A <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">Yes &emsp;&emsp;&emsp;&emsp;&emsp;  Where? '.$data['lethaility_assessment14'].'</td>
          </tr>
          <tr>
            <td>What actions have been taken to address client access to firearms: '.$data['lethaility_assessment15'].'</td>
          </tr>
          <tr>
            <td>Education offered to client and Collateral Risk &amp; Harm/Advisements Made? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">N/A </td>
          </tr>
          <tr>
            <td>Firearms/Weapons Safety Agreement Signed? &amp; Harm/Advisements Made? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">N/A </td>
          </tr>

          <tr>
            <td><br>Suicide:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Denies present or past ideations &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <input type="checkbox" name="date_eval" value="">Denies present or past attempts</td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">Ideation:</span> Age 1 st experienced:  '.$data['suicide3'].'&emsp;Other times experienced:  '.$data['suicide4'].'&emsp; Associated stressors: '.$data['suicide5'].'</td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">Plan:</span> Age 1 st experienced:  '.$data['suicide6'].'&emsp;&emsp; Other times experienced:  '.$data['suicide7'].'&emsp;&emsp; Associated stressors: '.$data['suicide8'].'</td>
          </tr>
          <tr>
            <td>History – Presenting attempts: '.$data['suicide9'].'</td>
          </tr>
          <tr>
            <td>Means – What weapons do you own/possess? '.$data['suicide10'].'</td>
          </tr>
          <tr>
            <td>Recent events (past 2 months): '.$data['suicide11'].'</td>
          </tr>
          <tr>
            <td>Past events (prior to 2 months): '.$data['suicide12'].'</td>
          </tr>
          <tr>
            <td>Immediate events before attempt: '.$data['suicide13'].'</td>
          </tr>
          <tr>
            <td>Have any family members attempted or completed suicide? <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">Yes, explain: '.$data['suicide16'].'</td>
          </tr>
          <tr>
            <td>Currently, what are your motivations to live? '.$data['suicide17'].'</td>
          </tr>
          <tr>
            <td>Risk factors: '.$data['suicide18'].'</td>
          </tr>
          <tr>
            <td>Protective factors: '.$data['suicide19'].'</td>
          </tr>

          <tr>
            <td><br>Homicide: <input type="checkbox" name="date_eval" value="">Denies</td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">Ideation:</span> Age 1 st experienced:  '.$data['homicide2'].'&emsp;Other times experienced:  '.$data['homicide3'].'&emsp; Associated stressors: '.$data['homicide4'].'</td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">Plan:</span> Age 1 st experienced:  '.$data['homicide5'].'&emsp;&emsp; Other times experienced:  '.$data['homicide6'].'&emsp;&emsp; Associated stressors: '.$data['homicide7'].'</td>
          </tr>
          <tr>
            <td><span style="text-decoration: underline;">History:</span> Age 1 st experienced:  '.$data['homicide8'].'&emsp;Other times experienced:  '.$data['homicide9'].'&emsp; Associated stressors: '.$data['homicide10'].'</td>
          </tr>
          <tr>
            <td> Age at additional attempts:  '.$data['homicide11'].'&emsp;Associated stressors?  '.$data['homicide12'].'</td>
          </tr>
          <tr>
            <td>Has a family member attempted or completed homicidal actions? <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">Yes</td>
          </tr>
          <tr>
            <td> If yes, please explain:  '.$data['homicide15'].'</td>
          </tr>
          <tr>
            <td><br> How bothered are you by your mental health? Not at all  '.$data['homicide16'].'</td>
          </tr>
          <tr>
            <td> How important to you is treatment for your mental health? Not at all  '.$data['homicide17'].'</td>
          </tr>

          <tr>
            <td style="text-decoration: underline;">OCCUPATION/SCHOOL</td>
          </tr>
          <tr>
            <td>Highest level of education: '.$data['occupation_school1'].' &emsp;&emsp; Are you currently in school? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>Are you presenting working? &emsp; <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No <input type="checkbox" name="date_eval" value="">Full-time <input type="checkbox" name="date_eval" value="">Part-time &emsp;&emsp;&emsp;&emsp; Where? '.$data['occupation_school8'].'</td>
          </tr>
          <tr>
            <td>Longest full time job? '.$data['occupation_school9'].'  &emsp;&emsp; Where? '.$data['occupation_school10'].'</td>
          </tr>
          <tr>
            <td> Has your substance use ever affect your performance at work/school? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td> If yes, impact on performance: <input type="checkbox" name="date_eval" value="">Mild <input type="checkbox" name="date_eval" value="">Moderate <input type="checkbox" name="date_eval" value="">Severe</td>
          </tr>
          <tr>
            <td>Explain: '.$data['occupation_school16'].'</td>
          </tr>
          <tr>
            <td>Other financial supports: '.$data['occupation_school17'].'</td>
          </tr>
          <tr>
            <td>Financial dependents: '.$data['occupation_school18'].'</td>
          </tr>
          <tr>
            <td>Number of days worked in the last 30 days: '.$data['occupation_school19'].'</td>
          </tr>

          <tr>
            <td><br><br>Developmental History</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Special Education <input type="checkbox" name="date_eval" value="">IEP in school <input type="checkbox" name="date_eval" value="">Did you attend an alternate high school/out of district placement?</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Intellectual/Learning Disability <input type="checkbox" name="date_eval" value="">Cognitive Deficits <input type="checkbox" name="date_eval" value="">FASD <input type="checkbox" name="date_eval" value="">ADHD/ADD <input type="checkbox" name="date_eval" value="">Documents provided <input type="checkbox" name="date_eval" value="">Client denies</td>
          </tr>
          <tr>
            <td>Physician/Psychologist name: '.$data['developmental_history10'].' &emsp;&emsp;Age formally tested: '.$data['developmental_history11'].'</td>
          </tr>
          <tr>
            <td>Additional notes: '.$data['developmental_history12'].'</td>
          </tr>
          
          <tr>
            <td style="text-decoration: underline;"><br>FAMILY</td>
          </tr>
          <tr>
            <td>Describe your upbringing (biological, adopted, siblings, etc.): '.$data['family1'].'</td>
          </tr>
          <tr>
            <td>Describe your current family: '.$data['family2'].'</td>
          </tr>
          
          <tr>
            <td><br>Who in your family/household has substance abuse/mental health issues?</td>
          </tr>
          <tr>
            <td>Relationship: '.$data['family3'].' Issue: '.$data['family4'].' Living with you? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>Relationship:'.$data['family7'].' Issue: '.$data['family8'].' Living with you? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>Relationship: '.$data['family11'].'; Issue: '.$data['family12'].' Living with you? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>

          <tr>
            <td><br>In the past 30 days have you had significant periods in which you have experienced serious problems getting along with:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Mother <input type="checkbox" name="date_eval" value="">Father <input type="checkbox" name="date_eval" value="">Brothers <input type="checkbox" name="date_eval" value="">Sisters <input type="checkbox" name="date_eval" value="">Sexual partner/spouse <input type="checkbox" name="date_eval" value="">Children <input type="checkbox" name="date_eval" value="">Other significant family <input type="checkbox" name="date_eval" value="">Close friends</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Neighbors <input type="checkbox" name="date_eval" value="">Co-workers <input type="checkbox" name="date_eval" value="">Client denies</td>
          </tr>
          
          <tr>
            <td><br>In your lifetime have you had significant periods in which you have experienced serious problems getting along with:</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Mother <input type="checkbox" name="date_eval" value="">Father <input type="checkbox" name="date_eval" value="">Brothers <input type="checkbox" name="date_eval" value="">Sisters <input type="checkbox" name="date_eval" value="">Sexual partner/spouse <input type="checkbox" name="date_eval" value="">Children <input type="checkbox" name="date_eval" value="">Other significant family <input type="checkbox" name="date_eval" value="">Close friends</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">Neighbors <input type="checkbox" name="date_eval" value="">Co-workers <input type="checkbox" name="date_eval" value="">Client denies</td>
          </tr>
          <tr>
            <td>Is your relationship with your family/household members negatively impacted? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>If yes, how? '.$data['family39'].'</td>
          </tr>
          <tr>
            <td>What does your family/household members think about your substance use? Are they supportive? '.$data['family40'].'</td>
          </tr>          

          <tr>
            <td style="text-decoration: underline;"><br>SOCIAL</td>
          </tr>
          <tr>
            <td>How many close friends do you have? Do any of them use? '.$data['social1'].'</td>
          </tr>
          <tr>
            <td>Are your social relationships negatively impacted? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>            
          </tr>
          <tr>
            <td>Explain: '.$data['social4'].'</td>
          </tr>

          <tr>
            <td><br>Do you spend most of your free time with: <input type="checkbox" name="date_eval" value="">Friends <input type="checkbox" name="date_eval" value="">Family <input type="checkbox" name="date_eval" value="">Alone</td>
          </tr>
          <tr>
            <td>Who do you turn to when you are troubled? '.$data['social8'].'</td>
          </tr>
          <tr>
            <td>Who will be your collateral contact(s) during your time in treatment? '.$data['social9'].'</td>
          </tr>
          <tr>
            <td>Release signed? <input type="checkbox" name="date_eval" value="">Yes </td>
          </tr>

          <tr>
            <td><br>How bothered are you by your family issues? Not at all '.$data['social11'].' Social issues? Not at all '.$data['social12'].'</td>
          </tr>
          <tr>
            <td>How important is treatment for your family issues? Not at all '.$data['social13'].' Social issues? Not at all '.$data['social14'].'</td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>ABUSE HISTORY</td>
          </tr>
          <tr>
            <td>Emotional: '.$data['abuse_history1'].'</td>
          </tr>
          <tr>
            <td>Physical: '.$data['abuse_history2'].'</td>
          </tr>
          <tr>
            <td>Sexual: '.$data['abuse_history3'].'</td>
          </tr>

          <tr>
            <td style="text-decoration: underline;">DOMESTIC VIOLENCE</td>
          </tr>
          <tr>
            <td>Have you ever received a temporary or final restraining order against you? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>Have you ever filed a restraining or final restraining order against anyone? <input type="checkbox" name="date_eval" value="">Yes <input type="checkbox" name="date_eval" value="">No</td>
          </tr>
          <tr>
            <td>Explain: '.$data['dome_voil5'].'</td>
          </tr>
          <tr>
            <td>Additional notes: '.$data['dome_voil6'].'</td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>PAIN ASSESSMENT</td>
          </tr>
          <tr>
            <td>Previous treatment for chronic pain: '.$data['pain_assess1'].'</td>
          </tr>
          <tr>
            <td>Providers Name: '.$data['pain_assess2'].'</td>
          </tr>
          <tr>
            <td>Previous treatment for chronic pain: '.$data['pain_assess3'].'</td>
          </tr>
          <tr>
            <td>Rate of pain (1-10 scale): <input type="checkbox" name="date_eval" value="">1 <input type="checkbox" name="date_eval" value="">2 <input type="checkbox" name="date_eval" value="">3 <input type="checkbox" name="date_eval" value="">4 <input type="checkbox" name="date_eval" value="">5 <input type="checkbox" name="date_eval" value="">6 <input type="checkbox" name="date_eval" value="">7 <input type="checkbox" name="date_eval" value="">8 <input type="checkbox" name="date_eval" value="">9 <input type="checkbox" name="date_eval" value="">10</td>
          </tr>

          <tr>
            <td><br>Current care (reason): '.$data['pain_assess14'].'</td>
          </tr>
          <tr>
            <td>Primary Care/Other: '.$data['pain_assess15'].'</td>
          </tr>
          <tr>
            <td>Psychiatrist: '.$data['pain_assess16'].'</td>
          </tr>
          <tr>
            <td>Therapist: '.$data['pain_assess17'].'</td>
          </tr>

          <tr>
            <td style="text-decoration: underline;"><br>LEGAL HISTORY</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="date_eval" value="">DUI’s &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Arrests &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Incarcerations &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Convictions &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Probation</td>
          </tr>
          <tr>
            <td>Explain: '.$data['legal_history6'].'</td>
          </tr>
          <tr>
            <td>How many times have you been charged with a crime? '.$data['legal_history7'].'</td>
          </tr>
          <tr>
            <td>Do you feel your legal problems are due to substance use? '.$data['legal_history8'].'</td>
          </tr>

          <tr>
            <td><br>How bothered are you by your legal issues? Not at all '.$data['legal_history9'].'</td>
          </tr>
          <tr>
            <td>How important to you is treatment for your legal issues? Not at all '.$data['legal_history10'].'</td>
          </tr>

          <tr>
            <td><br>SNAP ASSESSMENT</td>
          </tr>
          <tr>
            <td>Client’s Strengths: '.$data['snap_assessment1'].'</td>
          </tr>
          <tr>
            <td>Client’s Needs: '.$data['snap_assessment2'].'</td>
          </tr>
          <tr>
            <td>Client’s Abilities: '.$data['snap_assessment3'].'</td>
          </tr>
          <tr>
            <td>Client’s Preferences: '.$data['snap_assessment4'].'</td>
          </tr>

          <tr>
            <td><br>Mental Status Examination (check as appropriate)</td>
          </tr>
          <tr>
            <td style="font-size:12px; font-style: italic;">Please be prepared to write out and give support for your assessment, i.e., Client appears well groomed, bizarre, and inappropriate. Client was</td>
          </tr>
          <tr>
            <td style="font-size:12px; font-style: italic;">dressed for summer weather, wearing shorts and open shoes despite the cold temperature/winter season.</td>
          </tr>

          <tr>
            <td style="padding-bottom: 8px;"><br>Appearance: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Well-groomed &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Disheveled &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Bizarre &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Inappropriate: '.$data['appearance5'].'</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Attention: &emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Normal &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Easily distracted</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Concentration: &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Good &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Trouble concentrating</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Hallucinations: &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">None &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Auditory &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Visual &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Olfactory &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Command: '.$data['hallucinations6'].'</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Delusions: &emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">None &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Paranoid &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Grandeur &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Reference &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Other: '.$data['delusions6'].'</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Memory: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Intact <input type="checkbox" name="date_eval" value="">Impaired (check appropriate) &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Immediate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Recent &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Remote</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Intelligence: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Appears normal &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Low intelligence: '.$data['intelligence3'].'</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Orientation: &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">All spheres &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Impaired (check appropriate) &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Person &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Place &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Time</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Social judgement: &emsp;&emsp;<input type="checkbox" name="date_eval" value="">Appropriate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Impaired &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Harmful &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Unacceptable &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Unknown</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Insight: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Good &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Fair &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Poor &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Denial &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Blames others</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Impulse control: &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Intact &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Poor &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Unknown</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Thought content: ;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Appropriate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Suicide &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Homicide &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Illness &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Obsessions &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Fears</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Compulsions &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Somatic complaints &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Other: '.$data['thought_content10'].'</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Affect: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Appropriate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Flat &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Tearful &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Labile &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Inappropriate: '.$data['affect6'].'</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Mood: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Euthymic &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Depressed &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Manic &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Euphoric <input type="checkbox" name="date_eval" value="">Irritable &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Annoyed</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Speech: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Normal &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Slurred &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Slow &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Pressured &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Loud</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Behavior: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Appropriate &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Anxious &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Agitated &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Guarded &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Hostile &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Uncooperative</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">Thought Disorder: &emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Normal &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Narcissistic &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Paranoia &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Ideas of reference &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Tangential &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Confusion</td>
          </tr>
          <tr>
            <td style="padding-bottom: 8px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Loose associations &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Thought blocking &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Obsessions &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="date_eval" value="">Flight of ideas</td>
          </tr>

          <tr>
            <td><br>Other clinician observations: '.$data['clinician_observations'].'</td>
          </tr>          
        </table>

        <table style="width:100%;">
          <tr>
            <td style="width:40%; border: 1px solid black; text-align: center;">Please print Name</td>
            <td style="width:20%; border: 1px solid black; text-align: center;">Date</td>
            <td style="width:40%; border: 1px solid black; text-align: center;">Signature</td>
          </tr>
          <tr>
          <td style="border: 1px solid black; height:50px;">'.$data['text2'].'</td>
            <td style="border: 1px solid black;">'.$data['dat1'].'</td>
            <td style="border: 1px solid black;">';
            
              if($data['sign1']!=''){
                $print.= '<img src=data:image/png;base64,'.$data['sign1'].' style="width:20%;height:40px;" >';
            }
             
            
            $print.='</td>
          </tr>
          <tr>
        <td style="border: 1px solid black;">'.$data['text1'].'</td>
        <td style="border: 1px solid black;">'.$data['date2'].'</td>
        <td style="border: 1px solid black;">';
        if($data['sign2']!=''){
          $print.= '<img src=data:image/png;base64,'.$data['sign2'].' style="width:20%;height:40px;" >';
      }
       
      
      $print.='</td>
       
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
//$mpdf->showImageErrors = true;
$mpdf->WriteHTML($print);
$file='pdf/'.time().'.pdf';
$mpdf->Output($file,'I');

?>