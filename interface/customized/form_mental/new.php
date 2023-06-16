<?php

/**
 * Clinical instructions form.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2017-2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
if ($formid) {
    $sql = "SELECT * FROM `form_mental` WHERE id=? AND pid = ? AND encounter = ?";
    $res = sqlStatement($sql, array($formid,$_SESSION["pid"], $_SESSION["encounter"]));
    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
        $all[$iter] = $row;
    }
    $check_res = $all[0];
}

$check_res = $formid ? $check_res : array();
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo xlt("Form Medication"); ?></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
    	input[type=text] {
          border: none;
          border-bottom: 2px solid black;
}
h4{
   font-size: 18px;
}
.bt{
	width: 100px;
    margin: auto;
    margin-top: 10px;
    display: flex;
}
.container{
	border: 2px solid black;
}
b{
	font-size: 13px;
}
    </style>
</head>
<body>
 <div class="container mt-3">
  <div class="container-fluid">
    <form method="post" name="my_form" action="<?php echo $rootdir; ?>/forms/form_mental/save.php?id=<?php echo attr_url($formid); ?>">
    <div class="row">  
     <div class="col-12">
     	<h4 style="margin-bottom: 10px">Mental Status Examination(circle as appropriate)</h4>
     </div>    
     </div>
    </br>
     <div class="row">
        <div class="col-2">
        	<h4>Appearance:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="well" value="1"
             <?php 
        if($check_res['well']=="1"){
           echo "checked";
        }
        ?>
        ><b>Well-groomed</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="disheveled"  value="1"
             <?php 
        if($check_res['disheveled']=="1"){
           echo "checked";
        }
        ?>
             ><b>Disheveled</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="bizarre"  value="1"
             <?php 
        if($check_res['bizarre']=="1"){
           echo "checked";
        }
        ?>
             ><b>Bizarre</b>
        </div> 
        <div class="col-4">
        	<b>Inappropriate:</b><input type="text" name="inappropriate" value=" <?php echo text($check_res['inappropriate']); ?>">
        </div>  	
   </div>
   <br/>
    <div class="row">
        <div class="col-2">
        	<h4>Attention:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="normal"  value="1"
             <?php 
        if($check_res['normal']=="1"){
           echo "checked";
        }
        ?>
             ><b>Normal</b>
        </div>
         <div class="col-8">
        	<input type="checkbox" name="easily"  value="1"
             <?php 
        if($check_res['easily']=="1"){
           echo "checked";
        }
        ?>
             ><b>Easily Distracted:</b><input type="text" name="easilys" value=" <?php echo text($check_res['easilys']); ?>">
        </div>
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Concentration:</h4>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="good"  value="1"
             <?php 
        if($check_res['good']=="1"){
           echo "checked";
        }
        ?>
             ><b>Good</b>
        </div>
         <div class="col-9">
        	<input type="checkbox" name="concentration"  value="1"
             <?php 
        if($check_res['concentration']=="1"){
           echo "checked";
        }
        ?>
             ><b>Trouble Concentration:</b><input type="text" name="concentrations"  value=" <?php echo text($check_res['concentrations']); ?>">
        </div>
   </div>
   <br/>
    <div class="row">
        <div class="col-2">
        	<h4>Hallucinations:</h4>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="none"  value="1"
             <?php 
        if($check_res['none']=="1"){
           echo "checked";
        }
        ?>
             ><b>None</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="auditory"  value="1"
             <?php 
        if($check_res['auditory']=="1"){
           echo "checked";
        }
        ?>
             ><b>Auditory</b>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="visual"  value="1"
             <?php 
        if($check_res['visual']=="1"){
           echo "checked";
        }
        ?>
             ><b>Visual</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="factory"  value="1"
             <?php 
        if($check_res['factory']=="1"){
           echo "checked";
        }
        ?>
             ><b>Olfactory</b>
        </div>  
        <div class="col-4">
        	<input type="checkbox" name="command"  value="1"
             <?php 
        if($check_res['command']=="1"){
           echo "checked";
        }
        ?>
             ><b>Command:</b><input type="text" name="commands" value=" <?php echo text($check_res['commands']); ?>">
        </div>  	
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Delusion:</h4>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="nones"  value="1"
             <?php 
        if($check_res['nones']=="1"){
           echo "checked";
        }
        ?>
             ><b>None</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="paraniod"  value="1"
             <?php 
        if($check_res['paraniod']=="1"){
           echo "checked";
        }
        ?>
             ><b>Paraniod</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="grandeur"  value="1"
             <?php 
        if($check_res['grandeur']=="1"){
           echo "checked";
        }
        ?>
             ><b>Grandeur</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="reference"  value="1"
             <?php 
        if($check_res['reference']=="1"){
           echo "checked";
        }
        ?>
             ><b>Reference</b>
        </div>  
        <div class="col-3">
        	<input type="checkbox" name="other" value="1"
             <?php 
        if($check_res['other']=="1"){
           echo "checked";
        }
        ?>
             ><b>Other:</b><input type="text" name="otheres" value=" <?php echo text($check_res['otheres']); ?>">
        </div>  	
   </div>
   <br/>
    <div class="row">
        <div class="col-2">
        	<h4>Memory:</h4>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="intact" value="1"
             <?php 
        if($check_res['intact']=="1"){
           echo "checked";
        }
        ?>
             ><b>Intact</b>
        </div>
         <div class="col-3">
        	<input type="checkbox" name="impaired" value="1"
             <?php 
        if($check_res['impaired']=="1"){
           echo "checked";
        }
        ?>
             ><b>Impaired(check appropriate):</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="immediate" value="1"
             <?php 
        if($check_res['immediate']=="1"){
           echo "checked";
        }
        ?>
             ><b>Immediate</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="recent" value="1"
             <?php 
        if($check_res['recent']=="1"){
           echo "checked";
        }
        ?>
             ><b>Recent</b>
        </div>  
        <div class="col-2">
        	<input type="checkbox" name="remote" value="1"
             <?php 
        if($check_res['remote']=="1"){
           echo "checked";
        }
        ?>
             ><b>Remote:</b>
        </div>  	
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Intelligence:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="appears" value="1"
             <?php 
        if($check_res['appears']=="1"){
           echo "checked";
        }
        ?>
             ><b>Appears Normal</b>
        </div>
         <div class="col-8">
        	<input type="checkbox" name="lowintelligence" value="1"
             <?php 
        if($check_res['lowintelligence']=="1"){
           echo "checked";
        }
        ?>
             ><b>Low Intelligence:</b><input type="text" name="lowintelligences" value=" <?php echo text($check_res['lowintelligences']); ?>">
        </div>
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Orientation:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="spheres" value="1"
             <?php 
        if($check_res['spheres']=="1"){
           echo "checked";
        }
        ?>
             ><b>All Spheres</b>
        </div>
         <div class="col-3">
        	<input type="checkbox" name="impaireds" value="1"
             <?php 
        if($check_res['impaireds']=="1"){
           echo "checked";
        }
        ?>
             ><b>Impaired(circle appropriate):</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="person" value="1"
             <?php 
        if($check_res['person']=="1"){
           echo "checked";
        }
        ?>
             ><b>Person</b>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="place" value="1"
             <?php 
        if($check_res['place']=="1"){
           echo "checked";
        }
        ?>
             ><b>Place</b>
        </div>  
        <div class="col-2">
        	<input type="checkbox" name="time" value="1"
             <?php 
        if($check_res['time']=="1"){
           echo "checked";
        }
        ?>
             ><b>Time:</b>
        </div>  	
   </div>
   <br/>
   <div class="row">
        <div class="col-3">
        	<h4>Social Judgement:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="appropriates" value="1"
             
             <?php 
        if($check_res['appropriates']=="1"){
           echo "checked";
        }
        ?>><b>Appropriate</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="harmful" value="1"
             
             <?php 
        if($check_res['harmful']=="1"){
           echo "checked";
        }
        ?>><b>Harmful</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="unacceptable" value="1"
             <?php 
        if($check_res['unacceptable']=="1"){
           echo "checked";
        }
        ?>
             ><b>Unacceptable</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="unknown" value="1"
             <?php 
        if($check_res['unknown']=="1"){
           echo "checked";
        }
        ?>
             ><b>Unknown</b>
        </div>    	
   </div>
   <br/>
    <div class="row">
        <div class="col-2">
        	<h4>Insight:</h4>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="goods" value="1"
             <?php 
        if($check_res['goods']=="1"){
           echo "checked";
        }
        ?>
             ><b>Good</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="fair" value="1"
             <?php 
        if($check_res['fair']=="1"){
           echo "checked";
        }
        ?>
             ><b>Fair</b>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="poor" value="1"
             <?php 
        if($check_res['poor']=="1"){
           echo "checked";
        }
        ?>
             ><b>Poor</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="denial" value="1"
             <?php 
        if($check_res['denial']=="1"){
           echo "checked";
        }
        ?>
             ><b>Denial</b>
        </div>  
        <div class="col-4">
        	<input type="checkbox" name="blames" value="1"
             <?php 
        if($check_res['blames']=="1"){
           echo "checked";
        }
        ?>
             ><b>Blames Other</b>
        </div>  	
   </div>
   <br/>
   <div class="row">
        <div class="col-3">
        	<h4>Impluse Control:</h4>
        </div>
        <div class="col-3">
        	<input type="checkbox" name="intacts" value="1"
             
             <?php 
        if($check_res['intacts']=="1"){
           echo "checked";
        }
        ?>><b>Intact</b>
        </div>
        <div class="col-3">
        	<input type="checkbox" name="poors" value="1"
             
             <?php 
        if($check_res['poors']=="1"){
           echo "checked";
        }
        ?>><b>Poor</b>
        </div>
         <div class="col-3">
        	<input type="checkbox" name="unknowns" value="1"
             
             <?php 
        if($check_res['unknowns']=="1"){
           echo "checked";
        }
        ?>><b>Unknown</b>
        </div>  	
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Thought Content:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="appropriate" value="1"
             <?php 
        if($check_res['appropriate']=="1"){
           echo "checked";
        }
        ?>
             ><b>Appropriate</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="suicide" value="1"
             <?php 
        if($check_res['suicide']=="1"){
           echo "checked";
        }
        ?>
             ><b>Suicide</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="homicide" value="1"
             <?php 
        if($check_res['homicide']=="1"){
           echo "checked";
        }
        ?>
             ><b>Homicide</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="illness" value="1"
             <?php 
        if($check_res['illness']=="1"){
           echo "checked";
        }
        ?>
             ><b>Illness</b>
        </div> 
        <div class="col-2">
        	<input type="checkbox" name="compulsions" value="1"
             <?php 
        if($check_res['compulsions']=="1"){
           echo "checked";
        }
        ?>
             ><b>Compulsions</b>
        </div> 	
   </div>
   <div class="row">
   	  <div class="col-2">
        </div>   
   	  <div class="col-2">
        	<input type="checkbox" name="obsessions" value="1"
             <?php 
        if($check_res['obsessions']=="1"){
           echo "checked";
        }
        ?>
             ><b>Obsessions</b>
        </div> 
         <div class="col-1">
        	<input type="checkbox" name="fear" value="1"
             <?php 
        if($check_res['fear']=="1"){
           echo "checked";
        }
        ?>
             ><b>Fears</b>
        </div>
        <div class="col-3">
        	<input type="checkbox" name="somatic" value="1"
             <?php 
        if($check_res['somatic']=="1"){
           echo "checked";
        }
        ?>
             ><b>Somatic Complaints</b>
        </div>
         <div class="col-4">
        	<input type="checkbox" name="otherr" value="1"
             <?php 
        if($check_res['otherr']=="1"){
           echo "checked";
        }
        ?>
             ><b>other:</b><input type="text" name="otherrs"  value=" <?php echo text($check_res['otherrs']); ?>">
        </div>   
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Affect:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="appropriats" value="1"
             <?php 
        if($check_res['appropriats']=="1"){
           echo "checked";
        }
        ?>
             ><b>Appropriate</b>
        </div>
         <div class="col-8">
        	<input type="checkbox" name="inappropriates" value="1"
             <?php 
        if($check_res['inappropriates']=="1"){
           echo "checked";
        }
        ?>
             ><b>Inappropriate(describe):</b><input type="text" name="inappropriatee" value=" <?php echo text($check_res['inappropriatee']); ?>">
        </div>
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Mood:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="euthymic" value="1"
             <?php 
        if($check_res['euthymic']=="1"){
           echo "checked";
        }
        ?>
             ><b>Euthymic</b>
        </div>
         <div class="col-8">
        	<input type="checkbox" name="others" value="1"
             <?php 
        if($check_res['others']=="1"){
           echo "checked";
        }
        ?>
             ><b>Other:</b><input type="text" name="othee" value=" <?php echo text($check_res['othee']); ?>">
        </div>
   </div>
   <br/>
    <div class="row">
        <div class="col-2">
        	<h4>Speech:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="normals" value="1"
             <?php 
        if($check_res['normals']=="1"){
           echo "checked";
        }
        ?>
             ><b>Normal</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="slurres" value="1"
             <?php 
        if($check_res['slurres']=="1"){
           echo "checked";
        }
        ?>
             ><b>Slurres</b>
        </div>
        <div class="col-1">
        	<input type="checkbox" name="slow" value="1"
             <?php 
        if($check_res['slow']=="1"){
           echo "checked";
        }
        ?>
             ><b>Slow</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="pressured" value="1"
             <?php 
        if($check_res['pressured']=="1"){
           echo "checked";
        }
        ?>
             ><b>Pressured</b>
        </div>  
        <div class="col-2">
        	<input type="checkbox" name="loud" value="1"
             <?php 
        if($check_res['loud']=="1"){
           echo "checked";
        }
        ?>
             ><b>Loud</b>
        </div>  	
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Behavior:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="appropriatss" value="1"
             <?php 
        if($check_res['appropriatss']=="1"){
           echo "checked";
        }
        ?>
             ><b>Appropriate</b>
        </div>
         <div class="col-8">
        	<input type="checkbox" name="inappropriatess" value="1"
             <?php 
        if($check_res['inappropriatess']=="1"){
           echo "checked";
        }
        ?>
             ><b>Inappropriate(anxious,agitated,guarded,hostile,uncooperative)</b>
        </div>
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Thought Disorder:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="normales" value="1"
             <?php 
        if($check_res['normales']=="1"){
           echo "checked";
        }
        ?>
             ><b>Normal</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="narcissistic" value="1"
             <?php 
        if($check_res['narcissistic']=="1"){
           echo "checked";
        }
        ?>
             ><b>Narcissistic</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="homicides" value="1"
             <?php 
        if($check_res['homicides']=="1"){
           echo "checked";
        }
        ?>
             ><b>Homicide</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="ideas" value="1"
             <?php 
        if($check_res['ideas']=="1"){
           echo "checked";
        }
        ?>
             ><b>Ideas of Reference</b>
        </div> 
        <div class="col-2">
        	<input type="checkbox" name="tangential" value="1"
             <?php 
        if($check_res['tangential']=="1"){
           echo "checked";
        }
        ?>
             ><b>Tangential</b>
        </div> 	
   </div>
   <div class="row">
   	  <div class="col-2">
        </div>   
   	  <div class="col-2">
        	<input type="checkbox" name="loose" value="1"
             <?php 
        if($check_res['loose']=="1"){
           echo "checked";
        }
        ?>
             ><b>Loose Associations</b>
        </div> 
         <div class="col-2">
        	<input type="checkbox" name="confusion" value="1"
             <?php 
        if($check_res['confusion']=="1"){
           echo "checked";
        }
        ?>
             ><b>Confusion</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="blocking" value="1"
             <?php 
        if($check_res['blocking']=="1"){
           echo "checked";
        }
        ?>
             ><b>Thought Blocking</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="obsession" value="1"
             <?php 
        if($check_res['obsession']=="1"){
           echo "checked";
        }
        ?>
             ><b>Obsession</b>
        </div> 
        <div class="col-2">
        	<input type="checkbox" name="flight" value="1"
             <?php 
        if($check_res['flight']=="1"){
           echo "checked";
        }
        ?>
             ><b>Flight of ideas</b>
        </div>   
   </div>
   <br/>
    <div class="row">
   	  <div class="col-2">
   	  	<h4>Sleep:</h4>
        </div>   
   	  <div class="col-1">
        	<input type="checkbox" name="no" value="1"
             <?php 
        if($check_res['no']=="1"){
           echo "checked";
        }
        ?>
             ><b>No Change</b>
        </div> 
         <div class="col-1">
        	<input type="checkbox" name="interrupted" value="1"
             <?php 
        if($check_res['interrupted']=="1"){
           echo "checked";
        }
        ?>
             ><b>Interrupted</b>
        </div>
        <div class="col-4">
        	<input type="checkbox" name="increased" value="1"
             <?php 
        if($check_res['increased']=="1"){
           echo "checked";
        }
        ?>
             ><b>Increased</b><input type="text" name="increaseds"  value=" <?php echo text($check_res['increaseds']); ?>">
        </div>
        <div class="col-4">
        	<input type="checkbox" name="decreased" value="1"
             <?php 
        if($check_res['decreased']=="1"){
           echo "checked";
        }
        ?>
             ><b>Decreased</b><input type="text" name="decreaseds"  value=" <?php echo text($check_res['decreaseds']); ?>">
        </div>  
   </div>
   <br/>
    <div class="row">
        <div class="col-2">
        	<h4>Appetite:</h4>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="increasedes" value="1"
             <?php 
        if($check_res['increasedes']=="1"){
           echo "checked";
        }
        ?>
             ><b>Increased</b>
        </div>
         <div class="col-2">
        	<input type="checkbox" name="decreasedes" value="1"
             <?php 
        if($check_res['decreasedes']=="1"){
           echo "checked";
        }
        ?>
             ><b>decreased</b>
        </div>
        <div class="col-2">
        	<input type="checkbox" name="nochange" value="1"
             <?php 
        if($check_res['nochange']=="1"){
           echo "checked";
        }
        ?>
             ><b>No Change</b>
        </div> 	
   </div>
   <div class="row">
   	  <div class="col-2">
        </div>   
   	  <div class="col-4">
        	<input type="checkbox" name="weight" value="1"
             <?php 
        if($check_res['weight']=="1"){
           echo "checked";
        }
        ?>
             ><b>Weight Loss:</b><input type="text" name="weights"  value=" <?php echo text($check_res['weights']); ?>">
        </div> 
         <div class="col-4">
        	<input type="checkbox" name="gain" value="1"
             <?php 
        if($check_res['gain']=="1"){
           echo "checked";
        }
        ?>
             ><b>Weight Gain:</b><input type="text" name="gains"  value=" <?php echo text($check_res['gains']); ?>">
        </div>   
   </div>
   <br/>
   <div class="row">
        <div class="col-2">
        	<h4>Eating Disorders:</h4>
        </div>
        <div class="col-5">
        	<b>Anorexia</b><input type="text" name="anorexia"  value=" <?php echo text($check_res['anorexia']); ?>">
        </div>
         <div class="col-5">
        	<b>Bulemia</b><input type="text" name="bulemia"  value=" <?php echo text($check_res['bulemia']); ?>">
        </div> 	
   </div>
   <br/>
    <div class="row">
        <div class="col-4">
        	<h4>Self-Mutilation/Cutting Behaviors:</h4>
        </div>
        <div class="col-8">
        	<input type="text" name="anorexias"  value=" <?php echo text($check_res['anorexias']); ?>">
        </div>	
   </div>    
   <div class="btn-group bt" role="group">
                            <button type="submit" onclick='top.restoreSession()' class="btn btn-primary btn-save" style="margin-left: 15px;"><?php echo xlt('Save'); ?></button>
                            <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                        </div>           
    </form>
   </div>
  </div>
</body>
</html>