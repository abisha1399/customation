<?php
$ignoreAuth_onsite_portal = true;
$isPortal = true;
require_once("../../globals.php");
function pat_mail_check($pid){
					$temp = sqlQuery("select email from patient_data where pid = ?",array($pid));
					
					if (filter_var($temp['email'], FILTER_VALIDATE_EMAIL)) {
						return "1";
					}
					else
					{
						return "Please provide valid email for patient!";
					}

				}
$emailcheck=pat_mail_check($_POST['pc_pid']);
echo $emailcheck;
         die;
	// if($emailcheck==0)
	// {
	// 	echo "Please provide valid email for patient!";
	// 	die;
	// }
    // else
    // {
    //     echo "true";
    //     die;
    // }	
?>