<?php
/**
 * LBF form.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2009-2019 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

//echo 'ss';exit();

require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/patient.inc");
if (isset($GLOBALS['gbl_portal_cms_enable'])) {
    require_once("$include_root/cmsportal/portal.inc.php");
}
require_once($GLOBALS['fileroot'] . '/custom/code_types.inc.php');
require_once("$srcdir/FeeSheetHtml.class.php");
//echo "test";exit();
use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;
ini_set('display_errors',0);
$form_id = $_GET['form_id'];
// echo $form_id;
$formname = $_GET['formname'];
$edit_form_id = $_GET['edit_form_id'];
if($form_id !='')
{
	$result = sqlQuery("select * from form_builder where id=".$form_id." and form_type='lbf'");
    
}

if(isset($_GET['formname']))
{
    
	$form_id = explode("-",$formname)[1];
	// print_r($form_id);
	$result = sqlQuery("select * from form_builder where id=".$form_id." and form_type='lbf'");
 
	// $formValue = sqlStatement("select * from lbf_data where form_id=".$edit_form_id);
	if($result !='')
	{
		$formJSON = json_decode($result['form_json'],true);
		foreach($formJSON['formProperty'] as $index => $data)
		{	
            $data['inputfield_id']=isset($data['inputfield_id'])?$data['inputfield_id']:0;		
            $formDetails = sqlQuery("select * from lbf_data where form_id=".$edit_form_id." and field_id='".$data['inputName']."'");
                                                            
                if($formDetails !='')
                {
                    foreach($data['inputOptions'] as $optIndex=> $option)
                    {
                        $values = explode(",",$formDetails['field_value']); 
                        foreach($values as $value)
                        {
                        if($option['optValue'] == $value)
                        {
                            if($data['inputType']=='checkbox' || $data['inputType']=='radio')
                            {
                                $formJSON['formProperty'][$index]['inputOptions'][$optIndex]['check']='checked';
                            }
                            if($data['inputType']=='select')
                            {
                                $formJSON['formProperty'][$index]['inputOptions'][$optIndex]['check']='selected';
                            }
                        }
                        }
                    }
                    $formJSON['formProperty'][$index]['inputValue'] = $formDetails['field_value'];
                }
            // echo "<pre>";print_r($formJSON);
				
		}
		$result['form_json'] = json_encode($formJSON);
        
		// $result['edit_form_id'] = $edit_form_id;
		//  echo "<pre>";print_r($result);exit;
	}
}

?>

<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="../../patient_file/encounter/tooltip.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <br/>
  <br/><br/><br/><br/>
  <div class="panel panel-default">
    <div class="panel-heading" style="text-align: center;"><?=$result['form_name'];?></div>
    <div class="panel-body">
    	<div class="row">
            <input type='hidden' value='<?php echo $edit_form_id; ?>' id="edit_form_id">
    		<div id="render_form">
    		</div>
    	</div>
    </div>
    <div class="panel-footer">
    		<button type="button" class="btn btn-primary" onclick="saveForm()">Save</button>
    </div>
  </div>
</div>

</body>
<?php 
    $macro = sqlQuery("select * from patient_data where pid=$pid"); 
    $macro_date = sqlQuery("select * from openemr_postcalendar_events where pc_pid=$pid"); 
    $macro_vitals = sqlQuery("select * from form_vitals where pid=$pid"); 
    // echo '<pre>';print_r($macro_vitals);exit();
    //print_r ($macro['DOB']);
    //die;
    $datetime = date('d-m-Y h:i A');
    $time = date('h:i A');
    $date = date('d-m-Y');
?>
<script>        
     
    $(document).on('click', 'textarea', function() {
        var id=$(this).attr("id");
        if(id==undefined){
            var name1 = $(this).attr("name");
            $(this).attr("id",name1);
            id= name1;
        }
        var toolid = $(this).next().attr("id");
        var cls = $(this).next().attr("class");
        if(cls != undefined){
            $('#'+id+'_tool').remove();
        }else{
            $.ajax({
            url :'../../patient_file/encounter/tooltip.php',
            method:'post',                
            success:function(response){
                console.log(response);
                if($("#"+id+"_tool").length == 0){
                $('#'+id).after('<div id="'+id+'_tool" ></div>');
                $('#'+id+'_tool').addClass('desc');    
                $('#'+id+'_tool').html(response);                                      
                }
            }
        })                           

        $(document).on('click', '.labels_datas', function() {
        var text = $(this).attr('value');
        var dob ="<?php echo isset($macro['DOB']) ? $macro['DOB']:' '; ?>";
        var pat ="<?php echo $macro['fname'].' '.$macro['lname']; ?>";
        var edate ="<?php echo isset($macro_date['pc_eventDate'])  ? $macro_date['pc_eventDate']:' '; ?>";
        var etime ="<?php echo $macro_date['pc_eventDate'].' '.$macro_date['pc_startTime'];?>"; 

        var ss ="<?php echo isset($macro['ss']) ? $macro['ss']:' '; ?>";
        var sex ="<?php echo isset($macro['sex']) ? $macro['sex']:' '; ?>";
        var fname ="<?php echo isset($macro['fname']) ? $macro['fname']:' '; ?>";
        var squad ="<?php echo isset($macro['squad']) ? $macro['squad']:' '; ?>";
        var title ="<?php echo isset($macro['title']) ? $macro['title']:' '; ?>";
        var pubpid ="<?php echo isset($macro['pubpid']) ? $macro['pubpid']:' '; ?>";
        var status ="<?php echo isset($macro['status']) ? $macro['status']:' '; ?>";
        var pricelevel ="<?php echo isset($macro['pricelevel']) ? $macro['pricelevel']:' '; ?>";
        var birth_fname ="<?php echo isset($macro['birth_fname']) ? $macro['birth_fname']:' '; ?>";
        var billing_note ="<?php echo isset($macro['billing_note']) ? $macro['billing_note']:' '; ?>";
        var genericname1 ="<?php echo isset($macro['genericname1']) ? $macro['genericname1']:' '; ?>";
        var name_history ="<?php echo isset($macro['name_history']) ? $macro['name_history']:' '; ?>";
        var gender_identity ="<?php echo isset($macro['gender_identity']) ? $macro['gender_identity']:' '; ?>";
        var drivers_license ="<?php echo isset($macro['drivers_license']) ? $macro['drivers_license']:' '; ?>";
        var sexual_orientation ="<?php echo isset($macro['sexual_orientation']) ? $macro['sexual_orientation']:' '; ?>";
        var city ="<?php echo isset($macro['city']) ? $macro['city']:' '; ?>";
        var email ="<?php echo isset($macro['email']) ? $macro['email']:' '; ?>";
        var state ="<?php echo isset($macro['state']) ? $macro['state']:' '; ?>";
        var county ="<?php echo isset($macro['county']) ? $macro['county']:' '; ?>";
        var street ="<?php echo isset($macro['street']) ? $macro['street']:' '; ?>";
        var phone_biz ="<?php echo isset($macro['phone_biz']) ? $macro['phone_biz']:' '; ?>";
        var phone_cell ="<?php echo isset($macro['phone_cell']) ? $macro['phone_cell']:' '; ?>";
        var phone_home ="<?php echo isset($macro['phone_home']) ? $macro['phone_home']:' '; ?>";
        var mothersname ="<?php echo isset($macro['mothersname']) ? $macro['mothersname']:' '; ?>";
        var postal_code ="<?php echo isset($macro['postal_code']) ? $macro['postal_code']:' '; ?>";
        var country_code ="<?php echo isset($macro['country_code']) ? $macro['country_code']:' '; ?>";
        var phone_contact ="<?php echo isset($macro['phone_contact']) ? $macro['phone_contact']:' '; ?>";
        var email_direct ="<?php echo isset($macro['email_direct']) ? $macro['email_direct']:' '; ?>";
        var street_line_2 ="<?php echo isset($macro['street_line_2']) ? $macro['street_line_2']:' '; ?>";
        var contact_relationship ="<?php echo isset($macro['contact_relationship']) ? $macro['contact_relationship']:' '; ?>";
        var providerID ="<?php echo isset($macro['providerID']) ? $macro['providerID']:' '; ?>";
        var hipaa_voice ="<?php echo isset($macro['hipaa_voice']) ? $macro['hipaa_voice']:' '; ?>";
        var pharmacy_id ="<?php echo isset($macro['pharmacy_id']) ? $macro['pharmacy_id']:' '; ?>";
        var hipaa_notice ="<?php echo isset($macro['hipaa_notice']) ? $macro['hipaa_notice']:' '; ?>";
        var hipaa_message ="<?php echo isset($macro['hipaa_message']) ? $macro['hipaa_message']:' '; ?>";
        var hipaa_mail ="<?php echo isset($macro['hipaa_mail']) ? $macro['hipaa_mail']:' '; ?>";
        var hipaa_allowsms ="<?php echo isset($macro['hipaa_allowsms']) ? $macro['hipaa_allowsms']:' '; ?>";
        var imm_reg_status ="<?php echo isset($macro['imm_reg_status']) ? $macro['imm_reg_status']:' '; ?>";
        var patient_groups ="<?php echo isset($macro['patient_groups']) ? $macro['patient_groups']:' '; ?>";
        var publicity_code ="<?php echo isset($macro['publicity_code']) ? $macro['publicity_code']:' '; ?>";
        var ref_providerID ="<?php echo isset($macro['ref_providerID']) ? $macro['ref_providerID']:' '; ?>";
        var cmsportal_login ="<?php echo isset($macro['cmsportal_login']) ? $macro['cmsportal_login']:' '; ?>";
        var care_team_status ="<?php echo isset($macro['care_team_status']) ? $macro['care_team_status']:' '; ?>";
        var hipaa_allowemail ="<?php echo isset($macro['hipaa_allowemail']) ? $macro['hipaa_allowemail']:' '; ?>";
        var allow_imm_reg_use ="<?php echo isset($macro['allow_imm_reg_use']) ? $macro['allow_imm_reg_use']:' '; ?>";
        var prot_indi_effdate ="<?php echo isset($macro['prot_indi_effdate']) ? $macro['prot_indi_effdate']:' '; ?>";
        var protect_indicator ="<?php echo isset($macro['protect_indicator']) ? $macro['protect_indicator']:' '; ?>";
        var care_team_facility ="<?php echo isset($macro['care_team_facility']) ? $macro['care_team_facility']:' '; ?>";
        var care_team_provider ="<?php echo isset($macro['care_team_provider']) ? $macro['care_team_provider']:' '; ?>";
        var publ_code_eff_date ="<?php echo isset($macro['publ_code_eff_date']) ? $macro['publ_code_eff_date']:' '; ?>";
        var prevent_portal_apps ="<?php echo isset($macro['prevent_portal_apps']) ? $macro['prevent_portal_apps']:' '; ?>";
        var provider_since_date ="<?php echo isset($macro['provider_since_date']) ? $macro['provider_since_date']:' '; ?>";
        var allow_health_info_ex ="<?php echo isset($macro['allow_health_info_ex']) ? $macro['allow_health_info_ex']:' '; ?>";
        var allow_imm_info_share ="<?php echo isset($macro['allow_imm_info_share']) ? $macro['allow_imm_info_share']:' '; ?>";
        var allow_patient_portal ="<?php echo isset($macro['allow_patient_portal']) ? $macro['allow_patient_portal']:' '; ?>";
        var imm_reg_stat_effdate ="<?php echo isset($macro['imm_reg_stat_effdate']) ? $macro['imm_reg_stat_effdate']:' '; ?>";
        var em_city ="<?php echo isset($macro['em_city']) ? $macro['em_city']:' '; ?>";
        var em_name ="<?php echo isset($macro['em_name']) ? $macro['em_name']:' '; ?>";
        var em_state ="<?php echo isset($macro['em_state']) ? $macro['em_state']:' '; ?>";
        var industry ="<?php echo isset($macro['industry']) ? $macro['industry']:' '; ?>";
        var em_street ="<?php echo isset($macro['em_street']) ? $macro['em_street']:' '; ?>";
        var em_country ="<?php echo isset($macro['em_country']) ? $macro['em_country']:' '; ?>";
        var occupation ="<?php echo isset($macro['occupation']) ? $macro['occupation']:' '; ?>";
        var em_postal_code ="<?php echo isset($macro['em_postal_code']) ? $macro['em_postal_code']:' '; ?>";
        var em_street_line_2 ="<?php echo isset($macro['em_street_line_2']) ? $macro['em_street_line_2']:' '; ?>";
        var vfc ="<?php echo isset($macro['vfc']) ? $macro['vfc']:' '; ?>";
        var race ="<?php echo isset($macro['race']) ? $macro['race']:' '; ?>";
        var homeless ="<?php echo isset($macro['homeless']) ? $macro['homeless']:' '; ?>";
        var language ="<?php echo isset($macro['language']) ? $macro['language']:' '; ?>";
        var religion ="<?php echo isset($macro['religion']) ? $macro['religion']:' '; ?>";
        var ethnicity ="<?php echo isset($macro['ethnicity']) ? $macro['ethnicity']:' '; ?>";
        var contrastart ="<?php echo isset($macro['contrastart']) ? $macro['contrastart']:' '; ?>";
        var family_size ="<?php echo isset($macro['family_size']) ? $macro['family_size']:' '; ?>";
        var interpretter ="<?php echo isset($macro['interpretter']) ? $macro['interpretter']:' '; ?>";
        var monthly_income ="<?php echo isset($macro['monthly_income']) ? $macro['monthly_income']:' '; ?>";
        var migrantseasonal ="<?php echo isset($macro['migrantseasonal']) ? $macro['migrantseasonal']:' '; ?>";
        var referral_source ="<?php echo isset($macro['referral_source']) ? $macro['referral_source']:' '; ?>";
        var financial_review ="<?php echo isset($macro['financial_review']) ? $macro['financial_review']:' '; ?>";
        var regdate ="<?php echo isset($macro['regdate']) ? $macro['regdate']:' '; ?>";
        var userlist1 ="<?php echo isset($macro['userlist1']) ? $macro['userlist1']:' '; ?>";
        var userlist2 ="<?php echo isset($macro['userlist2']) ? $macro['userlist2']:' '; ?>";
        var userlist3 ="<?php echo isset($macro['userlist3']) ? $macro['userlist3']:' '; ?>";
        var userlist4 ="<?php echo isset($macro['userlist4']) ? $macro['userlist4']:' '; ?>";
        var userlist5 ="<?php echo isset($macro['userlist5']) ? $macro['userlist5']:' '; ?>";
        var userlist6 ="<?php echo isset($macro['userlist6']) ? $macro['userlist6']:' '; ?>";
        var userlist7 ="<?php echo isset($macro['userlist7']) ? $macro['userlist7']:' '; ?>";
        var usertext1 ="<?php echo isset($macro['usertext1']) ? $macro['usertext1']:' '; ?>";
        var usertext2 ="<?php echo isset($macro['usertext2']) ? $macro['usertext2']:' '; ?>";
        var usertext3 ="<?php echo isset($macro['usertext3']) ? $macro['usertext3']:' '; ?>";
        var usertext4 ="<?php echo isset($macro['usertext4']) ? $macro['usertext4']:' '; ?>";
        var usertext5 ="<?php echo isset($macro['usertext5']) ? $macro['usertext5']:' '; ?>";
        var usertext6 ="<?php echo isset($macro['usertext6']) ? $macro['usertext6']:' '; ?>";
        var usertext7 ="<?php echo isset($macro['usertext7']) ? $macro['usertext7']:' '; ?>";
        var usertext8 ="<?php echo isset($macro['usertext8']) ? $macro['usertext8']:' '; ?>";
        var deceased_reason ="<?php echo isset($macro['deceased_reason']) ? $macro['deceased_reason']:' '; ?>";
        


        var temp ="<?php echo isset($macro_vitals['temperature']) ? $macro_vitals['temperature']:' '; ?>";
        var weight ="<?php echo isset($macro_vitals['weight']) ? $macro_vitals['weight']:' '; ?>";
        var height ="<?php echo isset($macro_vitals['height'])? $macro_vitals['height']:' '; ?>";
        var pulse ="<?php echo isset($macro_vitals['pulse'])? $macro_vitals['pulse']:' '; ?>";
        var respiration ="<?php echo isset($macro_vitals['respiration'])? $macro_vitals['respiration']:' '; ?>";
        var BMI ="<?php echo isset($macro_vitals['BMI'])? $macro_vitals['BMI']:' '; ?>";
        var oxygen ="<?php echo isset($macro_vitals['oxygen_saturation'])? $macro_vitals['oxygen_saturation']:' '; ?>";
        var bps1 ="<?php echo isset($macro_vitals['bps_1'])? $macro_vitals['bps_1']:' '; ?>";
        var bps2 ="<?php echo isset($macro_vitals['bps_2'])? $macro_vitals['bps_2']:' '; ?>";
        var waist ="<?php echo isset($macro_vitals['waist_circ'])? $macro_vitals['waist_circ']:' '; ?>";
        var head ="<?php echo isset($macro_vitals['head_circ'])? $macro_vitals['head_circ']:' '; ?>";

        var datetime = "<?php echo $datetime; ?>";
        var time = "<?php echo $time; ?>";
        var date = "<?php echo $date; ?>";   
        
        text = text.replace('{{DOB}}',dob).replace('{{Patient Name}}',pat).replace('{{Service Date}}',edate).replace('{{Service Date & Time}}',etime).replace('{{Now}}',datetime).replace('{{Time}}',time).replace('{{Today}}',date).replace('{{Temperature}}',temp).replace('{{Weight}}',weight).replace('{{Height}}',height).replace('{{Pulse}}',pulse).replace('{{Respiration}}',respiration).replace('{{BMI}}',BMI).replace('{{Oxygen Saturation}}',oxygen).replace('{{BPS1}}',bps1).replace('{{BPS2}}',bps2).replace('{{Waist Circumference}}',waist).replace('{{Head Circumference}}',head).replace('{{ss}}',ss).replace('{{sex}}',sex).replace('{{fname}}',fname).replace('{{squad}}',squad).replace('{{title}}',title).replace('{{pubpid}}',pubpid).replace('{{status}}',status).replace('{{pricelevel}}',pricelevel).replace('{{birth_fname}}',birth_fname).replace('{{billing_note}}',billing_note).replace('{{genericname1}}',genericname1).replace('{{name_history}}',name_history).replace('{{gender_identity}}',gender_identity).replace('{{drivers_license}}',drivers_license).replace('{{sexual_orientation}}',sexual_orientation).replace('{{city}}',city).replace('{{email}}',email).replace('{{state}}',state).replace('{{county}}',county).replace('{{street}}',street).replace('{{phone_biz}}',phone_biz).replace('{{phone_cell}}',phone_cell).replace('{{phone_home}}',phone_home).replace('{{mothersname}}',mothersname).replace('{{postal_code}}',postal_code).replace('{{country_code}}',country_code).replace('{{phone_contact}}',phone_contact).replace('{{email_direct}}',email_direct).replace('{{street_line_2}}',street_line_2).replace('{{contact_relationship}}',contact_relationship).replace('{{providerID}}',providerID).replace('{{hipaa_voice}}',hipaa_voice).replace('{{pharmacy_id}}',pharmacy_id).replace('{{hipaa_notice}}',hipaa_notice).replace('{{hipaa_message}}',hipaa_message).replace('{{hipaa_allowsms}}',hipaa_allowsms).replace('{{imm_reg_status}}',imm_reg_status).replace('{{patient_groups}}',patient_groups).replace('{{publicity_code}}',publicity_code).replace('{{ref_providerID}}',ref_providerID).replace('{{cmsportal_login}}',cmsportal_login).replace('{{care_team_status}}',care_team_status).replace('{{hipaa_allowemail}}',hipaa_allowemail).replace('{{allow_imm_reg_use}}',allow_imm_reg_use).replace('{{prot_indi_effdate}}',prot_indi_effdate).replace('{{protect_indicator}}',protect_indicator).replace('{{care_team_facility}}',care_team_facility).replace('{{care_team_provider}}',care_team_provider).replace('{{publ_code_eff_date}}',publ_code_eff_date).replace('{{prevent_portal_apps}}',prevent_portal_apps).replace('{{provider_since_date}}',provider_since_date).replace('{{allow_health_info_ex}}',allow_health_info_ex).replace('{{allow_imm_info_share}}',allow_imm_info_share).replace('{{allow_patient_portal}}',allow_patient_portal).replace('{{imm_reg_stat_effdate}}',imm_reg_stat_effdate).replace('{{em_city}}',em_city).replace('{{em_name}}',em_name).replace('{{em_state}}',em_state).replace('{{industry}}',industry).replace('{{em_street}}',em_street).replace('{{em_country}}',em_country).replace('{{occupation}}',occupation).replace('{{em_postal_code}}',em_postal_code).replace('{{em_street_line_2}}',em_street_line_2).replace('{{vfc}}',vfc).replace('{{race}}',race).replace('{{homeless}}',homeless).replace('{{language}}',language).replace('{{religion}}',religion).replace('{{ethnicity}}',ethnicity).replace('{{contrastart}}',contrastart).replace('{{family_size}}',family_size).replace('{{interpretter}}',interpretter).replace('{{monthly_income}}',monthly_income).replace('{{migrantseasonal}}',migrantseasonal).replace('{{referral_source}}',referral_source).replace('{{financial_review}}',financial_review).replace('{{regdate}}',regdate).replace('{{userlist1}}',userlist1).replace('{{userlist2}}',userlist2).replace('{{userlist3}}',userlist3).replace('{{userlist4}}',userlist4).replace('{{userlist5}}',userlist5).replace('{{userlist6}}',userlist6).replace('{{userlist7}}',userlist7).replace('{{usertext1}}',usertext1).replace('{{usertext2}}',usertext2).replace('{{usertext3}}',usertext3).replace('{{usertext4}}',usertext4).replace('{{usertext5}}',usertext5).replace('{{usertext6}}',usertext6).replace('{{usertext7}}',usertext7).replace('{{usertext8}}',usertext8).replace('{{deceased_reason}}',deceased_reason).replace('{{hipaa_mail}}',hipaa_mail);

        var id =$(this).parent().parent().parent().prev().attr('id');
        // alert(id);
        insertAtCursor(document.getElementById(id), text);
        $('textarea').focus(); 
        });
        function insertAtCursor(myField, myValue) {
            //IE support
            if (document.selection) {
                myField.focus();
                sel = document.selection.createRange();
                sel.text = myValue;
            }
            //MOZILLA/NETSCAPE support
            else if (myField.selectionStart || myField.selectionStart == '0') {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                myValue = myValue;
                myField.value = myField.value.substring(0, startPos)
                    + myValue
                    + myField.value.substring(endPos, myField.value.length);
            } else {
            
                myField.value += myValue;
            }
        }     
    }                               
    });
     
    var formData = <?=json_encode($result);?>;
    var formFields = '';
    fetchFormFields();
    function fetchFormFields()
    {
        formFields = JSON.parse(formData.form_json);
        var html = '';
        formFields.formProperty.forEach(function(formVal,formi)
        {
            console.log(formVal);
                if(formVal.inputType=='select')
                {
                    html += selectBox(formVal);
                }
                else if(formVal.inputType=='textarea')
                {
                    html += textarea(formVal);
                }
                else if(formVal.inputType=='radio')
                {
                    html += radioBox(formVal);
                }else if(formVal.inputType=='checkbox')
                {
                    html +=checkBox(formVal);
                }else
                {
                    html += inputBox(formVal);
                }
                $("#render_form").html(html);
        });
    }

    function inputBox(formFieldData)
    {
        return '<div class="col-md-6 form-group"><label for="'+formFieldData.inputLabel+'">'+formFieldData.inputLabel+':</label><input type="'+formFieldData.inputType+'" class="'+ formFieldData.inputClass+' form-control" id="'+formFieldData.inputId+'" placeholder="'+formFieldData.inputPlaceholder+'" name="'+formFieldData.inputName+'" '+formFieldData.inputRequired+' value="'+formFieldData.inputValue+'"></div>';
    }

    function textarea(formFieldData)
    {
        return '<div class="col-md-6 form-group"><label for="'+formFieldData.inputLabel+'">'+formFieldData.inputLabel+':</label><textarea type="'+formFieldData.inputType+'" class="'+ formFieldData.inputClass+' form-control" rows=3 id="'+formFieldData.inputId+'" placeholder="'+formFieldData.inputPlaceholder+'" name="'+formFieldData.inputName+'" '+formFieldData.inputRequired+' value="'+formFieldData.inputValue+'" style="height:70px;">'+formFieldData.inputValue+'</textarea></div>';
    }

    function selectBox(formFieldData)
    {
        var html = '<div class="col-md-6 form-group"><label for="'+formFieldData.inputLabel+'">'+formFieldData.inputLabel+':</label><select type="'+formFieldData.inputType+'" class="'+ formFieldData.inputClass+' form-control" id="'+formFieldData.inputId+'" placeholder="'+formFieldData.inputPlaceholder+'" name="'+formFieldData.inputName+'" '+formFieldData.inputRequired+'>';
        var option_html = '';
        formFieldData.inputOptions.forEach(function(optVal,opti)
        {
            option_html +='<option value="'+optVal.optValue+'" '+optVal.check+'>'+optVal.optLabel+'</option>';
        });
        html += option_html +'</select></div>';
        return html;
    }

    function checkBox(formFieldData)
    {
        var option_html = '';
        formFieldData.inputOptions.forEach(function(optVal,opti)
        {
            var option = optVal.optLabel;
            var value = optVal.optValue;
                // optionArr.push({'option':option,'value':value});

            option_html += '<div class="col-md-12 form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="' + formFieldData.inputName + '[]" value="' + value + '" '+optVal.check+'>' + option + '</label></div>';
        })
        var html ='<div class="col-md-6"><label class="control-label" style="margin-left:3%">' + formFieldData.inputLabel + '</label>' + option_html + '</div>';
        return html;
    }

    function radioBox(formFieldData)
    {
        var option_html = '';
        formFieldData.inputOptions.forEach(function(optVal,opti)
        {
            var value = optVal.optValue;
            var option = optVal.optLabel;
            option_html += '<div class="col-md-12 form-check"><label class="form-check-label"><input type="radio" class="form-check-input" name="' + formFieldData.inputName + '" value="' + value + '" '+optVal.check+'>' + option + '</label></div>';
        });
        var html = '<div class="col-md-6"><label class="control-label" style="margin-left:3%">' + formFieldData.inputLabel + '</label>' + option_html + '</div>';
        return html;
    }


    function saveForm()
    {                       
        var validation = true;
        var records = [];

        formFields.formProperty.forEach(function(formVal,i)
        {
            console.log('each');
            
            validation = false;
            var field_value = '';
            var fieldName = formVal.inputName;
            if(typeof (formVal.inputfield_id)==='undefined')
            {
                var inputfield_id =0;
            }
            else{
                var inputfield_id =formVal.inputfield_id; 
            }
            
                if(formVal.inputType=='select')
                {
                    field_value = $('select[name="'+fieldName+'"] option:selected').val();
                    // alert($field_value);
                    if(field_value !='')
                    {
                        validation = true;
                    }
                }else if(formVal.inputType=='radio')
                {
                    field_value = $("input[name='"+fieldName+"']:checked").val();
                    console.log(182,field_value);

                    if(field_value !==undefined)
                    {
                        validation = true;
                    }
                }else if(formVal.inputType=='checkbox')
                {
                    var field_value = [];
                    $('input[name="'+fieldName+'[]"]:checked').each(function()
                    {
                            field_value.push($(this).val());
                    });

                    if(field_value.length !=0)
                    {
                        field_value = field_value.join(",");
                        validation = true;
                    }
                }
                else if(formVal.inputType=='textarea')
                {
                    field_value = $('textarea[name="'+fieldName+'"]').val();
                    if(field_value !='')
                    {
                        // alert(field_value);
                        validation = true;
                    }

                }
                else
                {
                    //alert(fieldName);
                    field_value = $('input[name="'+fieldName+'"]').val();
                    if(field_value !='')
                    {
                        // alert(field_value);
                        validation = true;
                    }
                }

                if(validation)
                {
                    records.push({'field_id':fieldName,'field_value':field_value,'inputfield_id':inputfield_id});

                }
        });
        console.log(records);

        if(records.length !=0)
        {
            edit_form_id = $('#edit_form_id').val();
            //inputfield_id
            
            $.ajax(
            {
                method : "POST",
                url :'save.php',
                data:{'data':records,'custom_form_id':formData.id,'formSumbit':'submit','form_name':formData.form_name,'form_id':edit_form_id,'inputfield_id':formData.inputfield_id},
                dataType : "JSON",
                success:function(res)
                {
                    console.log(res);
                    parent.closeTab(window.name, true);
                }
            })
        }
        
    }
</script>

</html>
