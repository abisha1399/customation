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
$pid = $_SESSION["pid"];
$encounter = $_GET["encounter"];


$check_res =array();

    $sql = "SELECT * FROM `form_ciwa` WHERE id = ? AND pid = ?";

    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);

    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'oxford_form.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<style>
    h2{
        text-align:center;
    }
</style>
<body id='body' class='body'>
<?php
ob_start();
?>
<h4 style="text-align:center;">CENTRE FOR NETWORK THERAPHY<BR>20 Gibson Palace,Suite 103<br>Freehold,NJ 07728<BR>732-431-5800</h4>
<table style="width:100%">
<tr>
    <td style="width:50%">
    <h4>Alcohol and Drug Service CIWA-Ar</h4>
</td>

    <td style="width:50%">
<b style="font-size:18px;font-size:18px;">Name:</b><?php echo text($check_res['input1']);?>
</td>
</tr>
<tr>
    <td style="width:50%">
</td>

    <td style="width:50%">
<b style="font-size:18px;">DOB:</b><?php echo text($check_res['input2']);?>
 <b style="font-size:18px;">
  M<input type="checkbox"  <?php echo isset($check_res['gender'])&&$check_res['gender']=='male'?'checked=checked':''; ?>>
  F<input type="checkbox"  <?php echo isset($check_res['gender'])&&$check_res['gender']=='female'?'checked=checked':''; ?>></b>
</td>
</tr>

</table>
<h3 style="text-align:center;">Alcohol Withdrawal Scale</h3>
<h3 style="text-align:center;">(CIWA-Ar)</h3>
  <table style="border:1px solid black;width:100%;">
      <tr>
        <td style="width:5%;border:1px solid black;"><p style="font-size:16px;font-weight:bolder;">0 <input type="checkbox"  <?php echo isset($check_res['rating'])&&$check_res['rating']=='0'?'checked=checked':''; ?>></p>Nil</td>
        <td style="width:7%;border:1px solid black;"><p style="font-size:16px;font-weight:bolder;">1 <input type="checkbox"  <?php echo isset($check_res['rating'])&&$check_res['rating']=='1'?'checked=checked':''; ?>></p> mild</b></td>
        <td style="width:7%;border:1px solid black;"><p style="font-size:16px;font-weight:bolder;">2<input type="checkbox"  <?php echo isset($check_res['rating'])&&$check_res['rating']=='2'?'checked=checked':''; ?>> &nbsp;
         3<input type="checkbox"  <?php echo isset($check_res['rating'])&&$check_res['rating']=='3'?'checked=checked':''; ?>></p> moderate</b></td>
        <td style="width:7%;border:1px solid black;"><p style="font-size:16px;font-weight:bolder;">4<input type="checkbox"  <?php echo isset($check_res['rating'])&&$check_res['rating']=='4'?'checked=checked':''; ?>></p> </b></td>
        <td style="width:7%;border:1px solid black;"><p style="font-size:16px;font-weight:bolder;">5<input type="checkbox"  <?php echo isset($check_res['rating'])&&$check_res['rating']=='5'?'checked=checked':''; ?>></p>Severe</td>
        <td style="width:7%;border:1px solid black;"><p style="font-size:16px;font-weight:bolder;">6<input type="checkbox"  <?php echo isset($check_res['rating'])&&$check_res['rating']=='6'?'checked=checked':''; ?>> &nbsp;
        7<input type="checkbox"  <?php echo isset($check_res['rating'])&&$check_res['rating']=='7'?'checked=checked':''; ?>></p>verysevere</b></td>
        <td style="width:17%;border:1px solid black;"><img src="uploads/pupil.png"/>  </td>
      </tr>
  </table><br>
  <table style="width:100%;border:1px solid black;" >
    <tr>
      <td style="border:2px solid black;width:20%;"> Date and Time of Last Use</b>


      <td style="border:2px solid black;width:7%"><b>Date<b></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input5']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input6']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input7']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input7_1']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input8']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input9']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input10']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input11']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input12']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input13']);?></td>

</tr>
<tr>
  <td style="border:2px solid black;width:20%"><b >Date:</b><?php echo text($check_res['input3']);?><br>
</td>
      <td style="border:2px solid black;width:7%"><b>Time<b></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input14']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input15']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input16']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input17']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input18']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input19']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input20']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input21']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input22']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input23']);?> </td>
</tr>
<tr>
  <td style="border:2px solid black;width:20%"><b >Time:</b><?php echo text($check_res['input4']);?></td>
</td>
      <td style="border:2px solid black;width:7%"><b>BAL<b></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input24']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input25']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input26']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input27']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input28']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input29']);?> </td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input30']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input31']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input32']);?></td>
      <td style="border:2px solid black;width:7%" ><?php echo text($check_res['input33']);?></td>
</tr>
</table>
<br><br>
<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:30%;border:1px solid black;">
<b>Nausea and vomiting </b>Ask ,"Do you feel <br>sick to your stomach?Have you<br> vomited"<br>
0  -no nausea or vomiting<br>
1  -mild nausea no vomiting<br>
2<br>
3<br>
4  -intermittent nausea with dry heaves<br>
5<br>
6<br>
7  -constant nausea,dry heaves.vomit

</td>
<td style="width:7%;border:2px solid black;"><?php echo text($check_res['input34']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input35']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input36']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input37']);?>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input38']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input39']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input40']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input41']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input42']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input43']);?> </td>
</tr>
<tr>
  <td style="width:30%;border:1px solid black;">
<b>Arms</b> extended  and fingers<br>Spread apart<br>
0  -no tremors<br>
1  -not visible but can be felt at fingertip<br>
2<br>
3<br>
4  -moderate with arms extended<br>
5<br>
6<br>
7  -severe with arms not attended

</td>
<td style="width:7%;border:2px solid black;"> <?php echo text($check_res['input44']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input45']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input46']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input47']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input48']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input49']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input50']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input51']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input52']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input53']);?> </td>
</tr>
<tr>
  <td style="width:30%;border:1px solid black;">
</td>
<td style="width:7%;border:2px solid black;"><?php echo text($check_res['input54']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input55']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input56']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input57']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input58']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input59']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input60']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input61']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input62']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input63']);?> </td>





</table><br><br><br><br>
<table style="width:100%">
<tr>
    <td style="width:50%">
    <h4>Alcohol and Drug Service CIWA-Ar</h4>
</td>

    <td style="width:50%">
<b style="font-size:18px;">Name:</b><?php echo text($check_res['input64']);?>
</td>
</tr>
<tr>
<td style="width:50%">
</td>


    <td style="width:50%">
<b style="font-size:18px;">DOB:</b><?php echo text($check_res['input65']);?>  <b style="font-size:18px;">
  M <input type="checkbox"  <?php echo isset($check_res['gender1'])&&$check_res['gender1']=='male'?'checked=checked':''; ?>>
  F <input type="checkbox"  <?php echo isset($check_res['gender1'])&&$check_res['gender1']=='female'?'checked=checked':''; ?>></b>
</td>
</tr>

</table><br>

<table style="width:100%;border:1px solid black;">
<tr>
    <br><br><br>
  <td style="width:30%;border:1px solid black;">
<b>Headche,fullness in head</b>Ask ,"Do you  head feel <br>different? Does it feels like a band around head?"<br>Do you  rate dizziness or light headedness <br>
0  -not present<br>
1  - very mild<br>
2  - mild<br>
1  - moderate<br>
4  - moderate severe<br>
5  - severe<br>
6  - very severe<br>
6  -  extremely severe<br>

</td>
<td style="width:7%;border:2px solid black;"><?php echo text($check_res['input66']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input67']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input68']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input69']);?>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input70']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input71']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input72']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input73']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input74']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input75']);?> </td>
</tr><tr>
  <td style="width:30%;border:1px solid black;">
<b>Orientation clouding of Sensorium:</b> Ask "what day is it",<BR>where are you,who am I.
0  -Oriented and can do serial additions<br>
1  -cant do  serial additions uncertain about dates<br>
2  -disoriented by date by 2 days<br>
3  -disoriented by date more than day<br>
4  -disoriented of place,and or person<br>

</td>
<td style="width:7%;border:2px solid black;"><?php echo text($check_res['input76']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input77']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input78']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input79']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input80']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input81']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input82']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input83']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input84']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input85']);?> </td>
</tr>
</table><br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br>

<table style="width:100%">
<tr>
    <td style="width:50%">
    <h4>Alcohol and Drug Service CIWA-Ar</h4>
</td>

    <td style="width:50%">
<b style="font-size:18px;">Name:</b> <?php echo text($check_res['input86']);?>
</td>
</tr>
<tr>
    <td style="width:50%">
</td>

    <td style="width:50%">
<b style="font-size:18px;">DOB:</b><?php echo text($check_res['input87']);?>
<b> M <input type="checkbox"  <?php echo isset($check_res['gender2'])&&$check_res['gender2']=='male'?'checked=checked':''; ?>>
    F <input type="checkbox"  <?php echo isset($check_res['gender2'])&&$check_res['gender2']=='female'?'checked=checked':''; ?>></b>
</td>
</tr>

</table><br>
<br>
<table style="width:100%;border:1px solid black;">
<tr>
  <td style="width:30%;border:1px solid black;">
<b>Visual Disturbances</b>: Ask, “Does the light appear to be too bright? Is the color different? Does it hurt your eyes? Are you seeing anything that is disturbing you? Are you seeing things you know are not there?”<br>
0  -not present<br>
1  -very mild sensitivity<br>
2  -mild sensitivity<br>
1  -moderate sensitivity<br>
4  -moderately severe hallucinations<br>
5  -severe sensitivity<br>
6  -moderately severe hallucinations<br>
6  -severe sensitivity<br>

</td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input88']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input89']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input90']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input91']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input92']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input93']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input94']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input95']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input96']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input97']);?></td>

</tr>
</table><br><br>
<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:30%;border:1px solid black;">
<b>Total score</b></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input98']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input99']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input100']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input101']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input102']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input103']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input104']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input105']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input106']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input107']);?></td>

</tr>
</table>

<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:30%;border:1px solid black;">
<b>Blood pressure</b></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input108']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input109']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input110']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input111']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input112']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input113']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input114']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input115']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input116']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input117']);?></td>


</tr>
<tr>
<td style="width:30%;border:1px solid black;">
<b>Pulse </b></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input118']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input119']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input120']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input121']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input122']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input123']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input124']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input125']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input126']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input127']);?></td>


</tr>
<tr>
<td style="width:30%;border:1px solid black;">
<b>Temperature</b></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input128']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input129']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input130']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input131']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input132']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input133']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input134']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input135']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input136']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input137']);?></td>


</tr>
<tr>
<td style="width:30%;border:1px solid black;">
<b>Respiration</b></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input138']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input139']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input140']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input141']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input142']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input143']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input144']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input145']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input146']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input147']);?></td>


</tr>
</table><br>
<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:20%;border:1px solid black;">
<b>Pupils
</b><br>
 React+ no reaction-
</td>
<td style="width:7%;border:2px solid black;">
<b>Size in mm
</b><br>
</td>
     <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input148']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input149']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input150']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input151']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input152']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input153']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input154']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input155']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input156']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input157']);?></td></tr>
      <tr>
      <td style="width:20%;border:1px solid black;">
Brisk B sluggish s</td>

<td style="width:7%;border:2px solid black;">
<b>Reaction
</b><br>
</td>
     <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input158']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input159']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input160']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input161']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input162']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input163']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input164']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input165']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input166']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input167']);?></td></tr>


</table><br><br>

<table style="width:100%;border:1px solid black;">
<tr>
<td style="width:30%;border:1px solid black;">
<b>Medication
</b><br>
</td>
     <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input168']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input169']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input170']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input171']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input172']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input173']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input174']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input175']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input176']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input177']);?></td></tr>
      <tr>
      <td style="width:30%;border:1px solid black;">
<b>Nurse Initial
</b><br>
</td>
     <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input178']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input179']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input180']);?></td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input181']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input182']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input183']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input184']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input185']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input186']);?> </td>
      <td style="width:7%;border:2px solid black;"><?php echo text($check_res['input187']);?></td></tr>
</table><br><br>

<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("CIWA Form");
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

$mpdf->Output('test.pdf', 'I');
// header("Location:7%.border:2px solid black;./../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();

?>
