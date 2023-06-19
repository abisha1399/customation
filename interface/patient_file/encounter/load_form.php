<?php

/**
 * load_form.php
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
require_once("../../../library/registry.inc.php");

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Twig\TwigContainer;
if (substr($_GET["formname"], 0, 15) === 'new_custom_form') {
    $form_id = explode("-",$_GET["formname"])[1];
    header("Location:../../customized/custom_form/new.php?form_id=".$form_id);
    exit;
}
if (substr($_GET["formname"], 0, 3) === 'LBF') {
    // Use the List Based Forms engine for all LBFxxxxx forms.
    include_once("$incdir/forms/LBF/new.php");
} else {
    if ((!empty($_GET['pid'])) && ($_GET['pid'] > 0)) {
        $pid = $_GET['pid'];
        $encounter = $_GET['encounter'];
    }

    // ensure the path variable has no illegal characters
    check_file_dir_name($_GET["formname"]);

    // ensure authorized to see the form
    if (!AclMain::aclCheckForm($_GET["formname"])) {
        $formLabel = xl_form_title(getRegistryEntryByDirectory($_GET["formname"], 'name')['name'] ?? '');
        $formLabel = (!empty($formLabel)) ? $formLabel : $_GET["formname"];
        echo (new TwigContainer(null, $GLOBALS['kernel']))->getTwig()->render('core/unauthorized.html.twig', ['pageTitle' => $formLabel]);
        exit;
    }
    if(is_file("$incdir/customized/" . $_GET["formname"] . "/new.php"))
    {
        include_once("$incdir/customized/" . $_GET["formname"] . "/new.php");
    }
    else{
        include_once("$incdir/forms/" . $_GET["formname"] . "/new.php");
    }

    
}

if (!empty($GLOBALS['text_templates_enabled'])) { ?>
    <script src="<?php echo $GLOBALS['web_root'] ?>/library/js/CustomTemplateLoader.js"></script>
<?php } ?>
