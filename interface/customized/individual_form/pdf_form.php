<?php
// ini_set("display_errors", 1);

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/classes/Address.class.php");
require_once("$srcdir/classes/InsuranceCompany.class.php");
require_once("$webserver_root/custom/code_types.inc.php");
include_once("$srcdir/patient.inc");
include_once("$srcdir/tcpdf/tcpdf_min/tcpdf.php");
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");


require_once("$srcdir/api.inc");

require_once("$srcdir/options.inc.php");

use OpenEMR\Common\Csrf\CsrfUtils;


$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$individual_data = $formid ? formFetch("form_individual_form", $formid) : array();

use OpenEMR\Core\Header;
// $mpdf = new mPDF('utf-8','A5-P',8, 10,10,10, 75, 30, 4, 10);
$mpdf = new mPDF();
?>
<body id='body' class='body'>
<?php

ob_start();
?><br />


<div style="text-align:center;flex;font-size: 19px;font-weight: 600;">Center for Network Therapy<br>81 Northfield Ave, Suite 104 West Orange,<br> NJ 07052   (973) 731-1375<br></div>

<table style="width:100%;" border='1' cellpadding="10" cellspacing="0" >
                                <tr >
                                <td style="width:50%; ">Client Name:<?php echo text($individual_data['client_name1'] ?? ''); ?></td>
                                <td style="width:50%">date: <?php echo text($individual_data['date1'] ?? ''); ?></td>
                                <td colspan="2"  >Code & Duration OV-Office .25<br><?php echo $individual_data['code'] ??''; ?></td>
                                </tr>
                                <tr style="font-size;18px;">
                                    <td colspan='4'><b>PROBLEM STATEMENT ADDRESSED IN TREATMENT PLAN: <b></td>
                                </tr>
                                <tr>
                                <td colspan='4' style="font-size;18px;">
                                CODES:
                                CODES:
                                 <b>OV-Office</b><input type="checkbox" name="code_pb1" value="on" <?php echo isset($individual_data['code_pb1'])&&$individual_data['code_pb1']=='on'?'checked=checked':''; ?>>
                                 V-Field Visit<input type="checkbox" name="code_pb2" value="on" <?php echo isset($individual_data['code_pb2'])&&$individual_data['code_pb2']=='on'?'checked=checked':''; ?>>
                                  G-Group<input type="checkbox" name="code_pb3" value="on" <?php echo isset($individual_data['code_pb3'])&&$individual_data['code_pb3']=='on'?'checked=checked':''; ?>>
                                  F-Family<input type="checkbox" name="code_pb4" value="on" <?php echo isset($individual_data['code_pb4'])&&$individual_data['code_pb4']=='on'?'checked=checked':''; ?>>
                                  PE-Psych Eval<input type="checkbox" name="code_pb5" value="on" <?php echo isset($individual_data['code_pb5'])&&$individual_data['code_pb5']=='on'?'checked=checked':''; ?>>
                                  L-Letter<input type="checkbox" name="code_pb6" value="on" <?php echo isset($individual_data['code_pb6'])&&$individual_data['code_pb6']=='on'?'checked=checked':''; ?>>
                                      TC-Phone Call<input type="checkbox" name="code_pb7" value="on" <?php echo isset($individual_data['code_pb7'])&&$individual_data['code_pb7']=='on'?'checked=checked':''; ?>>
                                         C-Cancelled Appt<input type="checkbox" name="code_pb8" value="on" <?php echo isset($individual_data['code_pb8'])&&$individual_data['code_pb8']=='on'?'checked=checked':''; ?>>
                                             FA-Failed Appt<input type="checkbox" name="code_pb9" value="on" <?php echo isset($individual_data['code_pb9'])&&$individual_data['code_pb9']=='on'?'checked=checked':''; ?>>
                                </td>
                                </tr>
                                <tr style="font-size;18px;">
                                    <td colspan='4'>TIME:&nbsp;&nbsp;.25 = 15 Minutes  &nbsp;&nbsp; .5 = 30 Minutes &nbsp;&nbsp;.75 = 45 Minutes &nbsp;&nbsp;1.00 = 1 Hour

                                </tr>
                                <tr>
                                    <td colspan='4'><center><b>ASAM DIMENSION(S)</b></center><br>
                                    <center>Please choose the dimension(s) that this note addresses</center><br>
                                    <input type="checkbox"  name='dimension1' value="Dimension1" <?php echo $individual_data['dimension1']&&$individual_data['dimension1']=='Dimension1'?'checked':'' ?>>Dimension 1
                                    <input type="checkbox"  name='dimension2' value="Dimension2" <?php echo $individual_data['dimension2']&&$individual_data['dimension2']=='Dimension2'?'checked':'' ?>>Dimension 2
                                    <input type="checkbox"  name='dimension3' value="Dimension3" <?php echo $individual_data['dimension3']&&$individual_data['dimension3']=='Dimension3'?'checked':'' ?>>Dimension 3
                                    <input type="checkbox"  name='dimension4' value="Dimension4" <?php echo $individual_data['dimension4']&&$individual_data['dimension4']=='Dimension4'?'checked':'' ?>>Dimension 4
                                    <input type="checkbox"  name='dimension5' value="Dimension5" <?php echo $individual_data['dimension5']&&$individual_data['dimension5']=='Dimension5'?'checked':'' ?>>Dimension 5
                                    <input type="checkbox"  name='dimension6' value="Dimension6" <?php echo $individual_data['dimension6']&&$individual_data['dimension6']=='Dimension6'?'checked':'' ?>>Dimension 6
                                </tr>
                                <tr>
                                    <td colspan='4'>DAP FORMAT</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width:50%">
                                    DATA: Client statements that capture the theme of the session.  Brief statements as quoted by the client may be used, as well as paraphrased summaries.<br>
                                    Observable data or information supporting the subjective statement.  This may include the physical appearance of the client (e.g., sweaty, shaky, comfortable, disheveled, well-groomed, well-nourished), vital signs, results of completed lab/diagnostics tests, and medications the client is currently taking or being prescribed.
                                    </td>
                                    <td colspan="2" style="width:50%">
                                    D: Clinician met with client to examine his treatment progress thus far…….
                                    <br><textarea name="treatment1" class="form-control"><?php echo $individual_data['treatment1'] ??''?></textarea>
                                    <br><br>
                                    The client presented and his/her mood was congruent with his/her affect. No SI/HI/AH/VH.
                                    <br><textarea name="client_present" class="form-control"><?php echo $individual_data['client_present'] ??''?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width:50%">
                                    ASSESSMENT: The counselor’s or clinician’s assessment of the situation, the session, and the client’s condition, prognosis, response to intervention, and progress in achieving treatment plan goals/objectives.  This may also include the diagnosis with a list of symptoms and information around a differential diagnosis.
                                    </td>
                                    <td colspan="2" style="width:50%">
                                    A: The client seemed to be in
                                    <br><textarea name="client_seem" class="form-control"> <?php echo $individual_data['client_seem'] ??''?></textarea>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width:50%">
                                    PLAN: The treatment plan moving forward, based on the clinical information acquired and the assessment
                                    </td>
                                    <td colspan="2" style="width:50%">
                                    P:
                                    <br><textarea name="treatment_plan" class="form-control"> <?php echo $individual_data['treatment_plan'] ??''?></textarea>

                                    </td>
                                </tr>
                                <tr>
                                <td colspan="2" width='30%'>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="2" style="width:50%">
                                <?php echo $individual_data['text1'] ??''?>
                                </td>
                                <td>
                                Clinician Signature:
                                <?php
                                if($individual_data['clinisian_signature']!='')
                                {
                                echo '<img style="height:50px;object-fit:cover;" src='.$individual_data['clinisian_signature'].'>';
                                }
                                ?>
                                <!-- <?php echo $individual_data['clinisian_signature'] ??''?> -->
                                </td>
                                <td>
                                Date:<?php echo $individual_data['clinisian_date1'] ??''?>
                                </td>
                                </tr>
                                <tr>
                                <td colspan="2" style="width:50%">
                                <?php echo $individual_data['text2'] ??''?>
                                </td>
                                <td>
                                Supervisor Signature:
                                <?php
                                if($individual_data['supervisor_signature']!='')
                                {
                                echo '<img style="height:50px;object-fit:cover;" src='.$individual_data['supervisor_signature'].'>';
                                }
                                ?>
                                 <!-- <?php echo $individual_data['supervisor_signature'] ??''?> -->
                                </td>
                                <td>
                                Date: <?php echo $individual_data['supervisor_date1'] ??''?>
                                </td>
                                </tr>
                            </table>





        <?php

        $html = ob_get_contents();
        ob_end_clean();
        // echo $html;die;
        $mpdf->setTitle("Personal drug");
        //$mpdf->SetHTMLHeader($header);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->defaultfooterline = 0;
        $mpdf->setFooter("Page: {PAGENO} of {nb}");
         //$mpdf->SetMargins(0,0,20);
        $mpdf->WriteHTML($html);

        //save the file put which location you need folder/filname
        $mpdf->Output("Personal drug.pdf", 'I');

        $mpdf->debug = true;
        //out put in browser below output function
        $mpdf->Output();
    ?>
    </body>
</html>

