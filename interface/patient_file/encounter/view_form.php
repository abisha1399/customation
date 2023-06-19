<?php

/**
 * view_form.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");

$clean_id = sanitizeNumber($_GET["id"]);
if (substr($_GET["formname"], 0, 11) === 'custom_form') {
    $form_id = explode("-",$_GET["formname"])[1];
    $id=$_GET['id'];

    // Use the List Based Forms engine for all LBFxxxxx forms.
    header("Location:../../customized/custom_form/new.php?form_id=".$form_id.'&edit_form_id='.$id.'&formname='.$_GET['formname']);
    exit;
}
if (substr($_GET["formname"], 0, 3) === 'LBF') {
    // Use the List Based Forms engine for all LBFxxxxx forms.
    include_once("$incdir/forms/LBF/view.php");
} else {
    // ensure the path variable has no illegal characters
    check_file_dir_name($_GET["formname"]);
    if(is_file("$incdir/customized/" . $_GET["formname"] . "/view.php"))
    {
        
        include_once("$incdir/customized/" . $_GET["formname"] . "/view.php");
    }
    else{        
        include_once("$incdir/forms/" . $_GET["formname"] . "/view.php");
    }

}

$id = $clean_id;

if (!empty($GLOBALS['text_templates_enabled'])) { ?>
    <script src="<?php echo $GLOBALS['web_root'] ?>/library/js/CustomTemplateLoader.js"></script>
<?php } ?>
