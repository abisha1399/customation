
$_POST['dimension1']= isset($_POST['dimension1'])?$_POST['dimension1']:' ';
$_POST['dimension2']= isset($_POST['dimension2'])?$_POST['dimension2']:' ';
$_POST['dimension3']= isset($_POST['dimension3'])?$_POST['dimension3']:' ';
$_POST['dimension4']= isset($_POST['dimension4'])?$_POST['dimension4']:' ';
$_POST['dimension5']= isset($_POST['dimension5'])?$_POST['dimension5']:' ';
$_POST['dimension6']= isset($_POST['dimension6'])?$_POST['dimension6']:' ';
if ($id && $id != 0)
{
    $newid = formUpdates("form_individual_form", $_POST, $id,$_GET['pid']);     
}
else
{    
    $newid = formSubmit("form_individual_form", $_POST, $_GET["pid"],$encounter);
    addForm($encounter, "Individual Notes", $newid, "individual_form", $pid, $userauthorized);
}
function formSubmits($tableName, $values, $id,$encounter,$authorized = "0")
{
    global $attendant_type;

    $sqlBindingArray = [$_SESSION['pid'],$encounter,$_SESSION['authUser'], $authorized];
    $sql = "insert into " . escape_table_name($tableName) . " set " .  escape_sql_column_name($attendant_type, array($tableName)) . "=?, encounter=?, user=?, authorized=?, activity=1, date = NOW(),";
    foreach ($values as $key => $value) {    
        if ($key == "csrf_token_form") {
            continue;
        }    
        
            $sql .= " " . escape_sql_column_name($key, array($tableName)) . " = ?,";
            $sqlBindingArray[] = $value;
       
    }

    $sql = substr($sql, 0, -1);
    return sqlInsert($sql, $sqlBindingArray);
}
function formUpdates($tableName, $values, $id, $authorized = "0")
{
    $sqlBindingArray = [$_SESSION['pid'], $_SESSION['authUser'], $authorized];
    $sql = "update " . escape_table_name($tableName) . " set pid =?, user=? ,authorized=?, activity=1, date = NOW(),";
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