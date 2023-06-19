<?php

require_once("../../globals.php");
require_once("$srcdir/forms.inc");
// echo '<pre>';print_r($_POST);exit();
if(isset($_POST['formSumbit']) && $_POST['formSumbit']=='submit')
{
    // echo "test";
	$newid = 0;
	$form_id = $_POST['form_id'];
    //echo $form_id;exit();
	$form_data = $_POST['data'];
	
	if($form_id !='')
	{
		//  echo "if";
		    //   foreach($form_data as $data)
        	//  {
	        // 	$field_id = $data['field_id'];
	        // 	$value = $data['field_value'];
		 	// 	$query = "REPLACE INTO lbf_data SET field_value = ?, " . "form_id = ?, field_id = ?";
            //     sqlStatement($query, array($value, $form_id, $field_id));
            // }
		sqlStatement("DELETE FROM lbf_data WHERE form_id = ?", array($form_id));
		foreach($form_data as $data)
        {
        	$field_id = $data['field_id'];
        	$value = $data['field_value'];
			$inputfield_id = isset($data['inputfield_id'])?$data['inputfield_id']:0;
			sqlStatement("INSERT INTO lbf_data " . "( form_id, field_id, field_value,inputfield_id ) VALUES ( ?, ?, ?,? )", array($form_id, $field_id, $value,$inputfield_id));
    	}
	}
	else
	{
        // echo "test123";		
		$form_id = sqlInsert("INSERT INTO lbf_data " . "( field_id, field_value ) VALUES ( '', '' )");
        sqlStatement("DELETE FROM lbf_data WHERE form_id = ? AND " . "field_id = ''", array($form_id));
		addForm($encounter, $_POST['form_name'], $form_id, 'custom_form-'.$_POST['custom_form_id'], $pid, $userauthorized);
        // echo $field_id;
		foreach($form_data as $data)
        {
        	$field_id = $data['field_id'];
        	$value = $data['field_value'];
			$inputfield_id = isset($data['inputfield_id'])?$data['inputfield_id']:0;
			sqlStatement("INSERT INTO lbf_data " . "( form_id, field_id, field_value,inputfield_id ) VALUES ( ?, ?, ?,? )", array($form_id, $field_id, $value,$inputfield_id));
    	}
    	
	}
	echo "1";

    exit();
}
?>