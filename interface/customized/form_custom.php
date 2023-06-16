<?php
function pdf_form($rootdir,$form_name,$formdir,$form_id){
    $result= "<a class='btn btn-primary btn-sm' title='" . xla('pdf this form') . "' " .
            "onclick=\"return openpdfForm(" . attr_js($formdir) . ", " .attr_js($form_name) . ", " . attr_js($form_id) . ")\">";
    $result.= "" . xlt('PDF') . "</a>";
    return $result;
   
}
?>