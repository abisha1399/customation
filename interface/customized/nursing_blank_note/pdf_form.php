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
// require_once __DIR__ . '/vendor/autoload.php';
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");

    $id= $_GET['id'];
    $data = sqlQuery("select * from form_nursing_blank_note where id='".$id."'");
    if ($data)
    {      
        $print = '
        <table  style="width:100%;">
            <tr style="text-align:center;">
                <th>Nursing Blank Note</th><br/><br/>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <th style="width:50%; padding:3px;">Patient name: '.$data['patient_name'].'</th>
                <th style="padding:3px;">Date: '.$data['app_date'].'</th>
            </tr>
        </table>
        <div>
        '.$data['text'].'
        </div>
        <table style="width:100%; border: 1px solid black">
            <tr>
                <td style="50% text-align:center;">
                <p><img src="data:image/png;base64,'.$data['sign'].'" width="100px" height="50px"></p>
                <p>Signature</p>
                </td>
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
