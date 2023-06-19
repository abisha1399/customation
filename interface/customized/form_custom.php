<?php
require_once(__DIR__ . "/../globals.php");
function pdf_form($rootdir,$form_name,$formdir,$form_id){
    $result= "<a class='btn btn-primary btn-sm' title='" . xla('pdf this form') . "' " .
            "onclick=\"return openpdfForm(" . attr_js($formdir) . ", " .attr_js($form_name) . ", " . attr_js($form_id) . ")\">";
    $result.= "" . xlt('PDF') . "</a>";
    return $result;
   
}
function formSubmit_new($tableName, $values, $id)
{
    global $attendant_type;

    $sqlBindingArray = [$id];
    $sql = "insert into " . escape_table_name($tableName) . " set " .  escape_sql_column_name($attendant_type, array($tableName)) . "=?, date = NOW(),";
    foreach ($values as $key => $value) {
        if ($key == "csrf_token_form") {
            continue;
        }
        if (strpos($key, "openemr_net_cpt") === 0) {
            //code to auto add cpt code
            if (!empty($value)) {
                $code_array = explode(" ", $value, 2);

                BillingUtilities::addBilling(date("Ymd"), 'CPT4', $code_array[0], $code_array[1], $_GET['id']);
            }
        } elseif (strpos($key, "diagnosis") == (strlen($key) - 10) && !(strpos($key, "diagnosis") === false )) {
            //case where key looks like "[a-zA-Z]*diagnosis[0-9]" which is special, it is used to auto add ICD codes
            //icd auto add ICD9-CM
            if (!empty($value)) {
                $code_array = explode(" ", $value, 2);
                BillingUtilities::addBilling(date("Ymd"), 'ICD9-M', $code_array[0], $code_array[1], $_GET['id']);
            }
        } else {
            $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
            $sqlBindingArray[] = $value;
        }
    }

    $sql = substr($sql, 0, -1);
    return sqlInsert($sql, $sqlBindingArray);


}
function formUpdate_new($tableName, $values, $id,$pid)
{
    $sqlBindingArray = [];

    $sql = "update " . escape_table_name($tableName) . " set pid =$pid, date = NOW(),";
    foreach ($values as $key => $value) {
        if ($key == "csrf_token_form") {
            continue;
        }
        $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
        $sqlBindingArray[] = $value;
    }

    $sql = substr($sql, 0, -1);
    $sql .= " where id=?";
    $sqlBindingArray[] = $id;
    return sqlInsert($sql, $sqlBindingArray);
}
function encsubmit($tableName, $values)
{
    $sqlBindingArray = [];
    $sql = "insert into " . escape_table_name($tableName) . " set ";
    foreach ($values as $key => $value) {      
        $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
        $sqlBindingArray[] = $value;        
    }
    $sql = substr($sql, 0, -1);   
    return sqlInsert($sql, $sqlBindingArray);
}
?>