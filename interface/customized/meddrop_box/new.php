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
use PhpMyAdmin\SqlQueryForm;

$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
$check_res= $formid ? formFetch("meddrop_box", $formid) : array();
$pid=$_SESSION['pid'];
$result = SqlQuery("SELECT * FROM patient_data where id=".$pid."");
$patint_name= $result['fname'].$result['lname'];
// $formid=1;
// $sign_data = SqlQuery("SELECT * FROM signaure Where id=".$formid."");
?>
<html>
    <head>
        <title><?php echo xlt("Med Drop Box Form"); ?></title>
        <?php Header::setupHeader(); ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href=" ../../customized/admission_orders/assets/css/jquery.signature.css">
    <style>
        .pen_icon {
            cursor: pointer;
        }
        .admissionord {
            font-family: 'Poppins';
        }

        .protocol {
            font-size: 20px;
        }
        .main_image img{
            align-items: center;


        }
        .row{
            margin-left: 100px !important;
        }

    </style>

    <?php Header::setupHeader(); ?>

        </head>
        <body>
        <div class="container mt-3">
            <div class="row">
                <form method="post" name="my_form" id="my_pat_form" action="<?php echo $rootdir; ?>/forms/meddrop_box/save.php?id=<?php echo attr_url($formid); ?>">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />

                    <div class="main_image" style="box-shadow: 5px 10px 10px 10px #888888;padding: 4px 217px 4px 217px;">
                    <img  src="../../forms/meddrop_box/meddrop.jpg">

                    </div>
                    <input type="hidden" name="formname"  value="<?php echo $patint_name; ?>" >

                    <div class="form-group mt-4" style="text-align:center">
                        <div class="btn-group" role="group">
                            <!-- <button type="button" class="btn btn-primary btn-save" style="margin-left: 15px;"><?php echo xlt('PDF'); ?></button> -->
                            <a href='../../forms/meddrop_box/pdf_form.php' class='btn btn-primary' title='View PDF' onclick='top.restoreSession()'><span>PDF</span></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>

</html>
