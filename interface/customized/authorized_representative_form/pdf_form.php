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
$pid = $_GET["pid"];
$encounter = $_GET["encounter"];
$data =array();

    $sql = "SELECT * FROM form_authorized WHERE id = $formid AND pid = $pid";

    $res = sqlStatement($sql);
    $data = sqlFetchArray($res);

  //  echo $sql;

    $check_res = $formid ? $check_res : array();

    // $filename = $GLOBALS['OE_SITE_DIR'].'/documents/cnt/'.$pid.'_'.$encounter.'_behaviour_symptoms.pdf';
    // print_r($filename);die;
use OpenEMR\Core\Header;

$mpdf = new mPDF('','','','',8, 10,10,10, 5, 10, 4, 10);
?>
<style>
</style>
<body id='body' class='body'>
<?php
$header ="<div class='row'style='line-height:1px;' >

</div>";

ob_start();

        ?>
        <div class="row">
               <div class="col-12">
                   <img style="margin-left:200px;" src="1.jpg" height="40px" width="280px"/>
               <h2 style="text-align: center;"><b><?php echo xlt('Authorized Representative Form'); ?></b></h2>
                </div>
        </div>
        <hr>
        <div class="container col-12 mt-2">
            <p style="font-size: 14px;"><b>Read this information first</b></p>
            <p style="font-size: 14px;text-align:justify;line-height:1.5;"><b>
            <?php echo $data['txt1']??"    
            The Authorized Representative form is used to identify the person(s) who are permitted to have
            the same rights you have to access your confidential protected health information. By signing
            this form, you are allowing ValueOptions® to release protected health information to the
            individual(s) named. Your signature also releases ValueOptions® from any liability of any
            nature in connection with the release of your protected health information provided that
            ValueOptions® follows the terms detailed in this form. ValueOptions® is not responsible for
            any use, misuse or secondary release of information by the individual(s) listed below."?></b></p>
        </div>
                    <hr/>
                    <div class="container col-12 mt-2">
                        <h4>Step 1:  Complete the demographic information for the member receiving services:</h4>
                    </div>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:50%;">
                        1.<label style="text-align:center;"><?php echo xlt($data['name']); ?></label>
                         <P style="text-align:center;"><b>Name</b></P>
                        <br/>
                        3.<label style="text-align:center;"><?php echo xlt($data['addr']); ?></label>
                        <P class="text-center"><b>Address</b></P>
                        <br/>
                        5.<label style="text-align:center;"><?php echo xlt($data['subscribe']); ?></label>
                        <P class="text-center"><b>Subscriber Name</b></P>

                    </td>
                    <td style="width:50%;">
                        2.<label style="text-align:center;"><?php echo xlt($data['date']); ?></label>
                        <P class="text-center"><b>Date of Birth</b></P>
                        <br/>
                        4.<label style="text-align:center;"><?php echo xlt($data['home']); ?></label>
                        <P class="text-center"><b> Home Phone Number</b></P>
                        <br/>
                        6.<label style="text-align:center;"><?php echo xlt($data['identify']); ?></label>
                        <P class="text-center"><b>Subscriber Identification Number</b></P>
                    </td>
                    </tr>
                    </table>
                    <hr/>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:50%;">
                       7.<label style="text-align:center;"><b>Member Signature</b></label>
                       <?php
                        if($data['sign']!='')
                        {
                        echo '<img style="height:50px;object-fit:cover;" src='.$data['sign'].'>';
                        }
                        ?>


                    </td>
                    <td style="width:50%;">
                    <label style="text-align:center;"><?php echo xlt($data['date1']); ?></label>
                    <P class="text-center"><b>Month/ Day/ Year</b></P>
                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td>
                    8.<label style="text-align:center;"><b>Parent/Guardian Signature (if required by State Law)</b></label>

                    <!-- <P class="text-center"></P> -->
                    <?php
                    if($data['par']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['par'].'>';
                    }
                    ?>
                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td>
                    9.<label style="text-align:center;"><b>Witness</b> </label>
                    <?php
                    if($data['witness']!='')
                    {
                    echo '<img style="height:50px;object-fit:cover;" src='.$data['witness'].'>';
                    }
                    ?>
                    </td>
                    </tr>
                    </table>

                    <hr/>
                    <div class="container col-12 mt-2">
                        <p style="font-size: 14px;"><b>Step 2: You <u>must attach</u> a copy of a document that proves an established relationship with the
                        person(s) you name. Examples include court documents, Durable Power of Attorney or a Health
                        Care Power of Attorney.<b></p>
                    </div>
                    <hr/>
                    <div class="container col-12 mt-2">
                        <h4>Step 3: Complete the demographic information for the Authorized Representative:</h4>
                    </div>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>10.Designated Representative:</b></label>
                    <P class="text-center"><b> </b></P>
                    </td>
                    <td style="width:60%;">
                    <label style="text-align:center;"><?php echo xlt($data['design']); ?></label>                    <P class="text-center"><b>Full Name</b></P>
                    </td>
                    </tr>
                    </table>
                    <br/>
                    <br/>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>11.Relationship to Member:</b></label>

                    </td>
                    <td style="width:60%;">
                    <label style="text-align:center;"><?php echo xlt($data['relation']); ?></label>
                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>12.Address of Designated Representative:</b></label>
                    <P class="text-center"></P>
                    <label><b></b></label>
                    <P class="text-center"><b></b></P>
                    </td>
                    <td style="width:60%;">
                    <label style="text-align:center;"><?php echo xlt($data['street']); ?></label>                    <P class="text-center"><b>Street Address</b></P>
                    <label style="text-align:center;"><?php echo xlt($data['city']); ?></label>                    <P class="text-center"><b>City, State and Zip Code</b></P>
                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>13.Phone Number:</b></label>
                    <label style="text-align:center;"><?php echo xlt($data['phone']); ?></label>                    <P class="text-center"><b>Home</b></P>
                </td>
                    <td style="width:60%;">
                    <label style="text-align:center;"><?php echo xlt($data['phone1']); ?></label>                    <P class="text-center"><b>Work</b></P>

                    </td>
                    </tr>
                    </table>
                    <table style="margin-top: 8px;width:100%;">
                    <tr>
                    <td style="width:40%;">
                    <label><b>14.Expiration Date:</b></label>

                    </td>
                    <td style="width:60%;">
                    <label style="text-align:center;"><?php echo xlt($data['date2']); ?></label>
                    </td>
                    </tr>
                    </table>
                    <br/>
                    <div class="container col-12 mt-2">
                        <p style="font-size:14px;"><b>
                        <?php echo $data['txt2']??"    
                        This designation will expire one (1) year from the date it was signed, upon revocation or on the
                    expiration date listed above, whichever occurs sooner. Upon expiration, a new designation must be
                    written in order to be valid. You may cancel this designation in writing at any time."?></b>
                    </p>
<!-- </div> -->
<!-- <h5 style='text-align:center;line-height:1px;'>A New View, Inc. </h5>
<h5 style='text-align:center;line-height:1px;'>2905 Harr Drive, Suite 102</h5>
<h5 style='text-align:center;line-height:1px;'>Midwest City, OK 73110-3049</h5>
<h5 style='text-align:center;line-height:1px;'>Office: 405-818-8364 Fax:</h5>     -->





            <?php
        ?>
<?php
$footer ="<table>
<tr>

<td style='width:45% font-size:10px align:center'>Page: {PAGENO} of {nb}</td>

</tr>
</table>";

//$footer .='<p style="text-align: center;">Progress Note: '.$provider_name.', MD Encounter DOS: '.date('m/d/Y',strtotime($enrow["encounterdate"])).'</p>';

$body = ob_get_contents();
ob_end_clean();
$mpdf->setTitle("Authorized Representative Form");
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

$mpdf->Output('Authorized Representative Request.pdf', 'I');
// header("Location:../../patient_file/encounter/forms.php");
//         //out put in browser below output function
$mpdf->Output();
?>
