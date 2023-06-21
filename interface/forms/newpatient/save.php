<?php

/**
 * Encounter form save script.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Roberto Vasquez <robertogagliotta@gmail.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Roberto Vasquez <robertogagliotta@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/forms.inc.php");
require_once("$srcdir/encounter.inc.php");
require_once("../../customized/form_custom.php");

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Services\CodeTypesService;
use OpenEMR\Services\EncounterService;
use OpenEMR\Services\FacilityService;
use OpenEMR\Services\ListService;

if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}
//echo '<pre>';print_r($_POST);exit();
$facilityService = new FacilityService();
$encounterService = new EncounterService();

if (
    $_POST['mode'] == 'new'
    && (
        $GLOBALS['enc_service_date'] == 'hide_both'
        || $GLOBALS['enc_service_date'] == 'show_edit'
    )
) {
    $date = (new DateTime())->format('Y-m-d H:i:s');
} elseif (
    $_POST['mode'] == 'update'
    && (
        $GLOBALS['enc_service_date'] == 'hide_both'
        || $GLOBALS['enc_service_date'] == 'show_new'
    )
) {
    $enc_from_id = sqlQuery("SELECT `encounter` FROM `form_encounter` WHERE `id` = ?", [intval($_POST['id'])]);
    $enc = $encounterService->getEncounterById($enc_from_id['encounter']);
    $enc_data = $enc->getData();
    $date = $enc_data[0]['date'];
} else {
    $date = isset($_POST['form_date']) ? DateTimeToYYYYMMDDHHMMSS($_POST['form_date']) : null;
}
$onset_date = isset($_POST['form_onset_date']) ? DateTimeToYYYYMMDDHHMMSS($_POST['form_onset_date']) : null;
$sensitivity = $_POST['form_sensitivity'] ?? null;
$pc_catid = $_POST['pc_catid'] ?? null;
$facility_id = $_POST['facility_id'] ?? null;
$billing_facility = $_POST['billing_facility'] ?? '';
$reason = $_POST['reason'] ?? null;
$mode = $_POST['mode'] ?? null;
$referral_source = $_POST['form_referral_source'] ?? null;
$class_code = $_POST['class_code'] ?? '';
$pos_code = $_POST['pos_code'] ?? null;
$in_collection = $_POST['in_collection'] ?? null;
$parent_enc_id = $_POST['parent_enc_id'] ?? null;
$encounter_provider = $_POST['provider_id'] ?? null;
$referring_provider_id = $_POST['referring_provider_id'] ?? null;
//save therapy group if exist in external_id column
$external_id = isset($_POST['form_gid']) ? $_POST['form_gid'] : '';

$discharge_disposition = $_POST['discharge_disposition'] ?? null;
$discharge_disposition = $discharge_disposition != '_blank' ? $discharge_disposition : null;

$facilityresult = $facilityService->getById($facility_id);
$facility = $facilityresult['name'];

$normalurl = "patient_file/encounter/encounter_top.php";

$nexturl = $normalurl;

$provider_id = $_SESSION['authUserID'] ? $_SESSION['authUserID'] : 0;
$provider_id = $encounter_provider ? $encounter_provider : $provider_id;

$encounter_type = $_POST['encounter_type'] ?? '';
$encounter_type_code = null;
$encounter_type_description = null;
$pat_profile_data=$_POST['pat_profile_data']?$_POST['pat_profile_data']:'';
if(isset($_SESSION['clone_encounter']))
{
   
    $date=DateTimeToYYYYMMDDHHMMSS(date('Y-m-d H:i'));
    $onset_date=$date;
}
// we need to lookup the codetype and the description from this if we have one
if (!empty($encounter_type)) {
    $listService = new ListService();
    $option = $listService->getListOption('encounter-types', $encounter_type);
    $encounter_type_code = $option['codes'] ?? null;
    if (!empty($encounter_type_code)) {
        $codeService = new CodeTypesService();
        $encounter_type_description = $codeService->lookup_code_description($encounter_type_code) ?? null;
    } else {
        // we don't have any codes installed here so we will just use the encounter_type
        $encounter_type_code = $encounter_type;
        $encounter_type_description = $option['title'];
    }
}

if ($mode == 'new') {
    $encounter = generate_id();
    addForm(
        $encounter,
        "New Patient Encounter",
        sqlInsert(
            "INSERT INTO form_encounter SET
                date = ?,
                onset_date = ?,
                reason = ?,
                facility = ?,
                pc_catid = ?,
                facility_id = ?,
                billing_facility = ?,
                sensitivity = ?,
                referral_source = ?,
                pid = ?,
                encounter = ?,
                pos_code = ?,
                class_code = ?,
                external_id = ?,
                parent_encounter_id = ?,
                provider_id = ?,
                discharge_disposition = ?,
                referring_provider_id = ?,
                encounter_type_code = ?,
                encounter_type_description = ?,
                in_collection = ?,
                pat_profile_data=?",
                
            [
                $date,
                $onset_date,
                $reason,
                $facility,
                $pc_catid,
                $facility_id,
                $billing_facility,
                $sensitivity,
                $referral_source,
                $pid,
                $encounter,
                $pos_code,
                $class_code,
                $external_id,
                $parent_enc_id,
                $provider_id,
                $discharge_disposition,
                $referring_provider_id,
                $encounter_type_code,
                $encounter_type_description,
                $in_collection,
                $pat_profile_data
            ]
        ),
        "newpatient",
        $pid,
        $userauthorized,
        $date
    );
    //customazation
    if(!empty($encounter)&&$GLOBALS['enable_send_mail_enc']==true)
    {
        send_mail($encounter,$pid);
    }
} elseif ($mode == 'update') {
    $id = $_POST["id"];
    $result = sqlQuery("SELECT encounter, sensitivity FROM form_encounter WHERE id = ?", array($id));
    if ($result['sensitivity'] && !AclMain::aclCheckCore('sensitivities', $result['sensitivity'])) {
        die(xlt("You are not authorized to see this encounter."));
    }

    $encounter = $result['encounter'];
    // See view.php to allow or disallow updates of the encounter date.
    $datepart = "";
    $sqlBindArray = array();
    if (AclMain::aclCheckCore('encounters', 'date_a')) {
        $datepart = "date = ?, ";
        $sqlBindArray[] = $date;
    }
    array_push(
        $sqlBindArray,
        $onset_date,
        $provider_id,
        $reason,
        $facility,
        $pc_catid,
        $facility_id,
        $billing_facility,
        $sensitivity,
        $referral_source,
        $class_code,
        $pos_code,
        $discharge_disposition,
        $referring_provider_id,
        $encounter_type_code,
        $encounter_type_description,
        $in_collection,
        $pat_profile_data,
        $id
    );
    sqlStatement(
        "UPDATE form_encounter SET
            $datepart
            onset_date = ?,
            provider_id = ?,
            reason = ?,
            facility = ?,
            pc_catid = ?,
            facility_id = ?,
            billing_facility = ?,
            sensitivity = ?,
            referral_source = ?,
            class_code = ?,
            pos_code = ?,
            discharge_disposition = ?,
            referring_provider_id = ?,
            encounter_type_code = ?,
            encounter_type_description = ?,
            in_collection = ?,
            pat_profile_data=?
            WHERE id = ?",
        $sqlBindArray
    );
} else {
    die("Unknown mode '" . text($mode) . "'");
}
//customazation
if(!empty($encounter)&&$pat_profile_data&&$GLOBALS['enable_enc_billingprofile']==true)
{
    $eid=0;
    add_billing_profile($encounter,$pat_profile_data,$pid,$eid); 
}
if(isset($_SESSION['clone_encounter'])){
    $old_encounter= $_SESSION['clone_encounter'];
    $new_encounter= $encounter;
    $forms_data=sqlstatement("SELECT * FROM forms WHERE encounter=? AND formdir!='newpatient' AND deleted=0",array($old_encounter));
     while($form_row=sqlFetchArray($forms_data))
     {
         if($form_row['formdir']=='eye_mag')
         {
             addForm($new_encounter, $form_row['form_name'], $form_row['form_id'], $form_row['formdir'], $form_row['pid']);
         }
         
         if(substr($form_row['formdir'], 0, 11)=='custom_form' || substr($form_row['formdir'], 0, 3)=='LBF')
         {
             
             $custom_form=sqlstatement("SELECT * FROM lbf_data  WHERE form_id=?",array($form_row['form_id']));
             $form_id = sqlInsert("INSERT INTO lbf_data " . "( field_id, field_value ) VALUES ( '', '' )");
             sqlStatement("DELETE FROM lbf_data WHERE form_id = ? AND " . "field_id = ''", array($form_id));
             addForm($new_encounter, $form_row['form_name'], $form_id, $form_row['formdir'], $form_row['pid']);
             while($data=sqlFetchArray($custom_form))
             {
                 $field_id = $data['field_id'];
                 $value = $data['field_value'];
                 $inputfield_id = isset($data['inputfield_id'])?$data['inputfield_id']:0;
                 sqlStatement("INSERT INTO lbf_data " . "( form_id, field_id, field_value,inputfield_id ) VALUES ( ?, ?, ?,? )", array($form_id, $field_id, $value,$inputfield_id));
             } 
     
         }
        
         else
         {
             $tableName='form_'.$form_row['formdir'];
             if($form_row['formdir']=='procedure_order')
             {
                 $tableName='procedure_order';
                 $select_table=sqlQuery("SELECT * FROM $tableName WHERE procedure_order_id=?",array($form_row['form_id']));
             }
             else{
                 $select_table=sqlQuery("SELECT * FROM $tableName WHERE id=?",array($form_row['form_id']));
             }    
             if(isset($select_table['id']))
             {
                 if(isset($select_table['encounter']))
                 {
                     $select_table['encounter']=$new_encounter;
                 }
                 unset($select_table['id']);
                 $newid=encsubmit($tableName,$select_table);
                 addForm($new_encounter, $form_row['form_name'], $newid, $form_row['formdir'],$form_row['pid']);                
             }
             else
             {
                 addForm($new_encounter, $form_row['form_name'], $form_row['form_id'], $form_row['formdir'],$form_row['pid']);
             }
             
         }
         
     }
     unset($_SESSION['clone_encounter']);
     
 }

setencounter($encounter);

// Update the list of issues associated with this encounter.
if (!empty($_POST['issues']) && is_array($_POST['issues'])) {
    sqlStatement("DELETE FROM issue_encounter WHERE " .
        "pid = ? AND encounter = ?", array($pid, $encounter));
    foreach ($_POST['issues'] as $issue) {
        $query = "INSERT INTO issue_encounter ( pid, list_id, encounter ) VALUES (?,?,?)";
        sqlStatement($query, array($pid, $issue, $encounter));
    }
}

$result4 = sqlStatement("SELECT fe.encounter,fe.date,openemr_postcalendar_categories.pc_catname FROM form_encounter AS fe " .
    " left join openemr_postcalendar_categories on fe.pc_catid=openemr_postcalendar_categories.pc_catid  WHERE fe.pid = ? order by fe.date desc", array($pid));
?>
<html>
<body>
    <script>
        EncounterDateArray = Array();
        CalendarCategoryArray = Array();
        EncounterIdArray = Array();
        Count = 0;
        <?php
        if (sqlNumRows($result4) > 0) {
            while ($rowresult4 = sqlFetchArray($result4)) {
                ?>
        EncounterIdArray[Count] =<?php echo js_escape($rowresult4['encounter']); ?>;
        EncounterDateArray[Count] =<?php echo js_escape(oeFormatShortDate(date("Y-m-d", strtotime($rowresult4['date'])))); ?>;
        CalendarCategoryArray[Count] =<?php echo js_escape(xl_appt_category($rowresult4['pc_catname'])); ?>;
        Count++;
                <?php
            }
        }
        ?>

        // Get the left_nav window, and the name of its sibling (top or bottom) frame that this form is in.
        // This works no matter how deeply we are nested

        var my_left_nav = top.left_nav;
        var w = window;
        for (; w.parent != top; w = w.parent) ;
        var my_win_name = w.name;
        my_left_nav.setPatientEncounter(EncounterIdArray, EncounterDateArray, CalendarCategoryArray);
        top.restoreSession();
        <?php if ($mode == 'new') { ?>
        my_left_nav.setEncounter(<?php echo js_escape(oeFormatShortDate($date)) . ", " . js_escape($encounter) . ", window.name"; ?>);
        // Load the tab set for the new encounter, w is usually the RBot frame.
        w.location.href = '<?php echo "$rootdir/patient_file/encounter/encounter_top.php"; ?>';
        <?php } else { // not new encounter ?>
        // Always return to encounter summary page.
        window.location.href = '<?php echo "$rootdir/patient_file/encounter/forms.php"; ?>';
        <?php } // end if not new encounter ?>

    </script>
</body>
</html>
