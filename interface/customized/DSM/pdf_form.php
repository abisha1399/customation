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
$dsm_data = $formid ? formFetch("form_dsm", $formid) : array();

use OpenEMR\Core\Header;
// $mpdf = new mPDF('utf-8','A5-P',8, 10,10,10, 75, 30, 4, 10);
$mpdf = new mPDF();
?>
<body id='body' class='body'>
<?php

ob_start();
?><br />


<div style="text-align:center;flex;font-size: 19px;font-weight: 600;">Center for Network Therapy<br>81 Northfield Ave, Suite 104 West Orange,<br> NJ 07052   (973) 731-1375<br></div>

<h4 style="margin:10px;">DSM V Diagnosis :<?php echo $dsm_data['diagnosis_name'] ??'';?>
                            <table style="width:100%"  cellpadding="10" cellspacing="0" >
                                <tr>
                                    <td><b>Use Disorder / Additional Mental Health Disorder</b><br>
                                         <?php echo $dsm_data['mental_disorder'] ??'';?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Personality Disorder / Intellectual Impairments </b><br>
                                        <?php echo $dsm_data['personal_disorder'] ??'';?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Medical Issues  </b><br>
                                         <?php echo $dsm_data['medical_isssue'] ??'';?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Contributing Stressors </b><br>
                                       <?php echo $dsm_data['contribute_stress'] ??'';?>
                                    </td>
                                </tr>
                            </table>
                            <div style="margin-top:50px;">
                             <table style="width:100%"  cellpadding="10" cellspacing="0">
                                <tr>
                                    <td style="width:50%;">Clinical Coordinator: <?php
                                    if($dsm_data['clinical_coordinator']!=''){
                                        echo '<img src='.$dsm_data['clinical_coordinator'].' style="width:20%;height:40px;" >';
                                    }

                                     ?></td>
                                    <td style="width:50%;">Admission Date: <?php echo $dsm_data['admission_dete1'] ??'';?></td>
                                </tr>
                                <tr>
                                    <td style="width:100%;" colspan="2"> <?php echo $dsm_data['text1'];?><br>
                                    <?php echo $dsm_data['diagnosis_name'] ??'';?>
                                </tr>
                                <tr>
                                    <td style="width:50%;">Clinical Supervisor: <?php
                                     if($dsm_data['clinical_supervisor']!=''){
                                        echo '<img src='.$dsm_data['clinical_supervisor'].' style="width:20%;height:40px;" >';
                                    }
                                   ?></td>
                                    <td style="width:50%;">Admission Date: <?php echo $dsm_data['admission_dete2'] ??'';?></td>
                                </tr>
                                <tr>
                                    <td style="width:100%;" colspan="2"><?php echo $dsm_data['text2'];?><br>
                                    <?php echo $dsm_data['msw'] ??'';?>
                                </tr>
                             </table>


        <?php

        $html = ob_get_contents();
        ob_end_clean();
        // echo $html;die;
        $mpdf->setTitle("DSM V");
        //$mpdf->SetHTMLHeader($header);
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->defaultfooterline = 0;
        $mpdf->setFooter("Page: {PAGENO} of {nb}");
         //$mpdf->SetMargins(0,0,20);
        $mpdf->WriteHTML($html);

        //save the file put which location you need folder/filname
        $mpdf->Output("DSM v.pdf", 'I');

        $mpdf->debug = true;
        //out put in browser below output function
        $mpdf->Output();
    ?>
    </body>
</html>

