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

    $sql = "SELECT * FROM `form_nutrition` WHERE id = ? AND pid = ?";
   
    $res = sqlStatement($sql, array($formid,$pid));
    $check_res = sqlFetchArray($res);
   
    $check_res = $formid ? $check_res : array();

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
<body>

<h4 style="text-align:center;">CENTRE FOR NETWORK THERAPHY<BR>20 Gibson Palace,Suite 103<br>Freehold,NJ 07728<BR>732-431-5800</h4><br><br>

<h4 style="text-align:center;">NUTRITIONAL FORM</h4><br><br>

<h1 style="text-align:center;">Center for Network Theraphy</h1>

<table style="width:100%;">
    <tr>

        <td>
        <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox1'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;  well nourished.&nbsp;
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox2'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Malnourished&nbsp;
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox3'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; Obese&nbsp;
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox4'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Indigestion&nbsp;
      
        
        <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox5'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; Food Allergies<br>
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox6'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; Coffee/Tea intake>5cups a day&nbsp;
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox7'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;soda/caffeine product intake/day<br>
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox8'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Recent Weight gain(amount):&nbsp;
    
      <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox9'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; Binging/purging&nbsp;
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox10'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Laxative use&nbsp;
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox11'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Hx choking<br>
    <label>Significant dental cavities</label>
        <input type="checkbox" name="checkbox4" value="0" <?php if ($check_res['checkbox12'] == "0") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; No&nbsp;
      <input type="checkbox" name="checkbox1" value="1" <?php if ($check_res['checkbox12'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; Yes<br>
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox13'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Braces&nbsp;
        <input type="checkbox" name="checkbox3" value="1" <?php if ($check_res['checkbox14'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;Retainers<br>&nbsp;

<p>Determine whether the patients meet any of the following criteria</p><br>

        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox15'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; yes&nbsp;

<input type="checkbox" name="checkbox1" value="0" <?php if ($check_res['checkbox15'] == "0") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; No    <b>      Nausea,vomiting,diarrhea,for 3 or more days</b><br>
        <input type="checkbox" name="checkbox2" value="1" <?php if ($check_res['checkbox16'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; yes&nbsp;
        <input type="checkbox" name="checkbox3" value="0" <?php if ($check_res['checkbox16'] == "0") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp; no      <b>     Difficulty swallowing</b><br>
        <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox17'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;  yes&nbsp;
    <input type="checkbox" name="checkbox4" value="0" <?php if ($check_res['checkbox17'] == "0") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;No    <b>  Unintentional weight loss(>10 lbs in last 10 months)</b><br>
       <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox18'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;  yes&nbsp;
    <input type="checkbox" name="checkbox4" value="0" <?php if ($check_res['checkbox18'] == "0") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;No  <b>   Active eating disorder including laxative use</b><br>
       <input type="checkbox" name="checkbox4" value="1" <?php if ($check_res['checkbox19'] == "1") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;  yes&nbsp;
    <input type="checkbox" name="checkbox4" value="0" <?php if ($check_res['checkbox19'] == "0") {
            echo "checked='checked'";}else{
      echo '';
    }?>>&nbsp;No   <b>   New onset/uncontrolled diabetes</b><br><br>
      
</td>


    </tr>
</table><br><br>

<table style="width:100%;">
<tr>
    <td style="width:50%;">
    <label>Favourite foods:</label><?php echo text($check_res['name1']);?>
        <td>
      

</tr>
<tr>
<td style="width:50%;">
    <label>Any additional comments:</label><?php echo text($check_res['name2']);?>
        <td>
</tr>
</table><br><br><br>
<b>If any other conditions that the above is identified which may  place the patient at potential nutritional risk,MD will be notified</b>

  

</body>




<?php
$footer ="<table>
<tr>

<td style='margin:50px;width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";
$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Nutrition Form");
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
// header("Location:../../patient_file/encounter/forms.php");
        //out put in browser below output function
        $mpdf->Output();

