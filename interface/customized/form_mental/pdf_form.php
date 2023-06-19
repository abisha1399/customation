<html>
  <head>
  <link rel="stylesheet" href="./style.css">
</head>

<?php
// ini_set("display_errors", 1);
require_once("../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
//include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");

$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$name = $_GET['formname'];
$pid = $_SESSION['pid'];;
$encounter = $_GET["encounter"];
$data =array();

if ($formid) {
    $sql = "SELECT * FROM form_mental WHERE id = ? AND pid = ?";
    $res = sqlStatement($sql, array($formid,$pid));
    // $data = sqlFetchArray($res);
    // print_r($data);die;

    for ($iter = 0; $row = sqlFetchArray($res); $iter++) {
      $all[$iter] = $row;
  }
  $check_res = $all[0];
}
    $check_res = $formid ? $check_res : array();
    //print_r($check_res);die;
    
   // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    
use OpenEMR\Core\Header;

use Mpdf\Mpdf;
$mpdf = new mPDF();
?>
<?php
$header ="<div style='color:white;background-color:#808080;text-align:center;padding-top:8px;'>
<h2>Mental Status Examination</h2>
</div>";
ob_start();
 ?>
 <div class="container mt-3" style="width:100%">
 <div class="container-fluid">
 <div class="row">  
 <table class="table table-bordered" style="width: 100%;border:1px solid black;height:100%">
        <thead>
    	<tr>
    		<td colspan="6" style="padding-bottom: 10px;font-size:15px"><b>Mental Status Examination(circle as appropriate)</b></td>
    	</tr> 
        <tr>
    		<td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Appearance:</b></td>
            <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="well" value="1"
             <?php 
        if($check_res['well']=="1"){
            echo "checked='checked'";
        }
        ?>
        ><b>Well-groomed</b></td>

        <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="disheveled" value="1"
             <?php 
        if($check_res['disheveled']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Disheveled</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="bizarre" value="1"
             <?php 
        if($check_res['bizarre']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Bizarre</b></td> 
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b>Inappropriate:</b><?php echo text($check_res['inappropriate']); ?></b>
             </td>         
        </tr>  
        <tr>
    		<td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Attention:</b></td>
            <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="normal" value="1"
             <?php 
        if($check_res['normal']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Normal</b></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b>	<input type="checkbox" name="easily"  value="1"
             <?php 
        if($check_res['easily']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Easily Distracted:</b><?php echo text($check_res['inappropriate']); ?></b></td> 
    	</tr> 

        <tr>
    		<td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Concentration:</b></td>
            <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="good" value="1"
             <?php 
        if($check_res['good']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Good</b></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="concentration"  value="1"
             <?php 
        if($check_res['concentration']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Concentration:</b><?php echo text($check_res['concentrations']); ?></b></td>  
    	</tr> 

        <tr>
        <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Hallucinations:</b></td>
        <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="none"  value="1"
             <?php 
        if($check_res['none']=="1"){
            echo "checked='checked'";
        }
        ?>><b>None</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b>	<input type="checkbox" name="auditory"  value="1"
             <?php 
        if($check_res['auditory']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Auditory</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="visual"  value="1"
             <?php 
        if($check_res['visual']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Visual</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="factory"  value="1"
             <?php 
        if($check_res['factory']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Olfactory</b></td>
        <td colspan="6" style="padding-bottom: 10px;font-size:15px"><b>	<input type="checkbox" name="command"  value="1"
             <?php 
        if($check_res['command']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Command:</b><?php echo text($check_res['commands']); ?></b></td>
        </tr>

        <tr>
        <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Delusion:</b></td>
        <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="nones"  value="1"
             <?php 
        if($check_res['nones']=="1"){
            echo "checked='checked'";
        }
        ?>><b>None</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b>	<input type="checkbox" name="paraniod"  value="1"
             <?php 
        if($check_res['paraniod']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Paraniod</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="grandeur"  value="1"
             <?php 
        if($check_res['grandeur']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Grandeur</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="reference"  value="1"
             <?php 
        if($check_res['reference']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Reference</b></td>
        <td colspan="6" style="padding-bottom: 10px;font-size:15px"><b>	<input type="checkbox" name="other"  value="1"
             <?php 
        if($check_res['other']=="1"){
            echo "checked='checked'";
        }
        ?>>Other:<b><?php echo text($check_res['otheres']); ?></td>
        </tr>
        <tr>
        <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Memory:</b></td>
        <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="intact"  value="1"
             <?php 
        if($check_res['intact']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Intact</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="impaired"  value="1"
             <?php 
        if($check_res['impaired']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Impaired(check appropriate):</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="immediate"  value="1"
             <?php 
        if($check_res['immediate']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Immediate</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="recent"  value="1"
             <?php 
        if($check_res['recent']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Recent</b></td>
        <td colspan="6" style="padding-bottom: 10px;font-size:15px"><b>	<input type="checkbox" name="remote"  value="1"
             <?php 
        if($check_res['remote']=="1"){
            echo "checked='checked'";
        }
        ?>>Remote</td>
        </tr>
        <tr>
    		<td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Intelligence:</b></td>
            <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="appears" value="1"
             <?php 
        if($check_res['appears']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Appears Normal</b></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b>	<input type="checkbox" name="lowintelligence"  value="1"
             <?php 
        if($check_res['lowintelligence']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Low Intelligence:</b><?php echo text($check_res['lowintelligences']); ?></b></td> 
    	</tr> 

        <tr>
         <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Delusion:</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="spheres" value="1"
             <?php 
        if($check_res['spheres']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>All Spheres</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="impaireds" value="1"
             <?php 
        if($check_res['impaireds']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Impaired(circle appropriate):</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="person" value="1"
             <?php 
        if($check_res['person']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Person</b></td>
             <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="place" value="1"
             <?php 
        if($check_res['place']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Place</b></td>
             <td colspan="3" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="time" value="1"
             <?php 
        if($check_res['time']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Time</b></td>
        </tr>

        <tr>
         <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Social Judgement:</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="appropriates" value="1"
             <?php 
        if($check_res['appropriates']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Appropriate</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="harmful" value="1"
             <?php 
        if($check_res['harmful']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Harmful</b></td>
             <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="unacceptable" value="1"
             <?php 
        if($check_res['unacceptable']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Unacceptable</b></td>
             <td colspan="6" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="unknown" value="1"
             <?php 
        if($check_res['unknown']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Unknown</b></td>
       </tr>
       <tr>
         <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Insight:</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="goods" value="1"
             <?php 
        if($check_res['goods']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Good</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="fair" value="1"
             <?php 
        if($check_res['fair']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Fair</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="poor" value="1"
             <?php 
        if($check_res['poor']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Poor</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="denial" value="1"
             <?php 
        if($check_res['denial']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Denial</b></td>
             <td colspan="6" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="blames" value="1"
             <?php 
        if($check_res['blames']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Blames Other</b></td>
      </tr>

      <tr>
         <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Thought Content:</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="appropriate" value="1"
             <?php 
        if($check_res['appropriate']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Appropriate</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="suicide" value="1"
             <?php 
        if($check_res['suicide']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Suicide</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="homicide" value="1"
             <?php 
        if($check_res['homicide']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Homicide</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="illness" value="1"
             <?php 
        if($check_res['illness']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Illness</b></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="compulsions" value="1"
             <?php 
        if($check_res['compulsions']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Obsession</b></td>

   </tr>
       <tr>
       <td colspan="2" style="padding-bottom: 10px;font-size:15px"></td>
       <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="obsessions" value="1"
             <?php 
        if($check_res['obsessions']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Compulsions</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="fear" value="1"
             <?php 
        if($check_res['fear']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Fears</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="somatic" value="1"
             <?php 
        if($check_res['somatic']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Somatic Complaints</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="otherr" value="1"
             <?php 
        if($check_res['otherr']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>other:<?php echo text($check_res['otherrs']); ?></b></td>
   </tr>
   <tr>
    		<td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Affect:</b></td>
            <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="appropriats" value="1"
             <?php 
        if($check_res['appropriats']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Appropriate</b></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="inappropriates"  value="1"
             <?php 
        if($check_res['inappropriates']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Inappropriate(describe):</b><?php echo text($check_res['inappropriatee']); ?></b></td> 
    	</tr> 
        <tr>
    		<td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Mood:</b></td>
            <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="euthymic" value="1"
             <?php 
        if($check_res['euthymic']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Euthymic</b></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="others"  value="1"
             <?php 
        if($check_res['others']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Other:</b><?php echo text($check_res['othee']); ?></b></td> 
    	</tr> 

        <tr>
         <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Speech:</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="normals" value="1"
             <?php 
        if($check_res['normals']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Normal</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="slurres" value="1"
             <?php 
        if($check_res['slurres']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Slurres</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="slow" value="1"
             <?php 
        if($check_res['slow']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Slow</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="pressured" value="1"
             <?php 
        if($check_res['pressured']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Pressured</b></td>
             <td colspan="6" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="loud" value="1"
             <?php 
        if($check_res['loud']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Loud</b></td>
      </tr>
      <tr>
    		<td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Behavior:</b></td>
            <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="appropriatss" value="1"
             <?php 
        if($check_res['appropriatss']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Appropriate</b></td>
             <td colspan="6" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="inappropriatess"  value="1"
             <?php 
        if($check_res['inappropriatess']=="1"){
            echo "checked='checked'";
        }
        ?>><b>Inappropriate
            (anxious,agitated,guarded,hostile,uncooperative)</td> 
    	</tr> 

        <tr>
         <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Thought Disorder:</b></td>
         <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="normales" value="1"
             <?php 
        if($check_res['normales']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Normal</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="narcissistic" value="1"
             <?php 
        if($check_res['narcissistic']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Narcissistic</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="homicide" value="1"
             <?php 
        if($check_res['homicide']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Homicide</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="ideas" value="1"
             <?php 
        if($check_res['ideas']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Ideas of Reference</b></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="tangential" value="1"
             <?php 
        if($check_res['tangential']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Tangential</b></td>

   </tr>
       <tr>
       <td colspan="2" style="padding-bottom: 10px;font-size:15px"></td>
        <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="loose" value="1"
             <?php 
        if($check_res['loose']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Loose Associations</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="confusion" value="1"
             <?php 
        if($check_res['confusion']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Confusion</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="blocking" value="1"
             <?php 
        if($check_res['blocking']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Thought Blocking</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="obsession" value="1"
             <?php 
        if($check_res['obsession']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Obsession</b></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="flight" value="1"
             <?php 
        if($check_res['flight']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Flight of ideas</b></td>
   </tr>

   <tr>
       <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Sleep:</td>
        <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="no" value="1"
             <?php 
        if($check_res['no']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>No Change</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="interrupted" value="1"
             <?php 
        if($check_res['interrupted']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Interrupted</b></td>
    </tr>
    <tr>
    <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b></td>
        <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="increased" value="1"
             <?php 
        if($check_res['increased']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Increased</b><?php echo text($check_res['increaseds']); ?></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="decreased" value="1"
             <?php 
        if($check_res['decreased']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Decreased</b><?php echo text($check_res['decreaseds']); ?></td>
    </tr>
    <tr>
       <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b>Appetite:</td>
        <td colspan="2" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="increasedes" value="1"
             <?php 
        if($check_res['increasedes']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Increased</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="decreasedes" value="1"
             <?php 
        if($check_res['decreasedes']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>decreased</b></td>
             <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="nochange" value="1"
             <?php 
        if($check_res['nochange']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>No Change</b></td>
    </tr>
    <tr>
    <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b></td>
        <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="weight" value="1"
             <?php 
        if($check_res['weight']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Weight Loss:</b><?php echo text($check_res['weights']); ?></td>
             <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b><input type="checkbox" name="gain" value="1"
             <?php 
        if($check_res['gain']=="1"){
            echo "checked='checked'";
        }
        ?>
             ><b>Weight Gain:</b><?php echo text($check_res['gains']); ?></td>
    </tr>
    <tr>
    <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b>Eating Disorders:</td>
    <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b>Anorexia:</b><?php echo text($check_res['anorexia']); ?></td>
    <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b>Bulemia:</b><?php echo text($check_res['bulemia']); ?></td>

    </tr>
    <tr>
    <td colspan="1" style="padding-bottom: 10px;font-size:15px"><b>Self-Mutilation/Cutting Behaviors:</td>
    <td colspan="4" style="padding-bottom: 10px;font-size:15px"><b>Anorexia:</b><?php echo text($check_res['anorexias']); ?></td>
    </tr>
</thead>
</table>

  </div>
 </div>
</div>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Mental Status Examination");
$mpdf->SetDisplayMode('fullpage');
$mpdf->setAutoTopMargin = 'stretch';
$mpdf->setAutoBottomMargin = 'stretch';
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($body);
$mpdf->defaultfooterline = 0;
//         //save the file put which location you need folder/filname
// $checkid = sqlQuery("SELECT formid FROM pdf_directory WHERE formid=?", array($formid));
// if($checkid['formid'] != $formid){
//     $pdf_data = sqlInsert('INSERT INTO pdf_directory (path,pid,encounter,formid) VALUES (?,?,?,?)',array($filename,$_SESSION["pid"],$_SESSION["encounter"],$formid));
// }

$mpdf->Output("Mental.pdf", 'I');
//header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
</html>