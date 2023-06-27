<?php
// getting Access Token after 2 Hours

if(isset($_GET["refresh_token"])){

  $client_id='a40cdd23faf144fd877e567a8ecf0ede';
  $client_secret='2775df12d322a52201f15e7771456d86';
  $grant_type='refresh_token';
  $id=$_SESSION['authUserID'];

//    $sql=sqlQuery('SELECT refresh_token,code FROM users WHERE id='.$id.'');
  $old_refresh_token=$_SESSION['Refresh_token'];


  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://auth.1up.health/oauth2/token');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/x-www-form-urlencoded',
  ]);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'client_id='.$client_id.'&client_secret='.$client_secret.'&refresh_token='.$old_refresh_token.'&grant_type='.$grant_type.'');
  $result = curl_exec($ch);
  $response =json_decode($result);

if(!empty($response->access_token)){
   $access_token=$response->access_token;
   $refresh_token=$response->refresh_token;
   
   $token_query=sqlStatement("UPDATE users SET access_token='".$access_token."',refresh_token='". $refresh_token."' where id ='$id'");
   echo "success";
}
else{

   $err = curl_error($ch);
   echo $err;
}

  curl_close($ch);
  exit;
}
//Getting Access Token End

// 1Up Health Integration
function oneup_health($resource){

  if($resource=="user"){

  $sql = sqlQuery("select * from users where username = ?", array($_SESSION['authUser'])); 
  $code=$sql["code"];

  if($code=="0" || $code==""){ 
    $client_id='a40cdd23faf144fd877e567a8ecf0ede';
    $client_secret='2775df12d322a52201f15e7771456d86';
    $grant_type='authorization_code';
    $id=$_SESSION['authUserID'];
    // echo $result;die;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.1up.health/user-management/v1/user');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'client_id='.$client_id.'&app_user_id='.$_SESSION['authUserID'].'&client_secret='.$client_secret.'');

    $result = curl_exec($ch);

    $response=json_decode($result);
    // echo $response->code;die;
    if($response->success==true){ 

    $response_code = $response->code;

    $code_query=sqlStatement("UPDATE users SET code=".$response_code." where id =".$id."");

    //Get Access Token

    $sql=sqlQuery('SELECT code FROM users WHERE id='.$id.'');
    $new_code=$sql['code'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://auth.1up.health/oauth2/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'client_id='.$client_id.'&client_secret='.$client_secret.'&code='.$new_code.'&grant_type='.$grant_type.'');

    $result1 = curl_exec($ch);
    $response=json_decode($result1);

    if(!empty($response->access_token)){
       $refresh_token=$response->refresh_token;
       $access_token=$response->access_token; 
    //    print_r($access_token);
    $token_query=sqlStatement('UPDATE users SET access_token='.$access_token.',refresh_token='.$refresh_token.' where id ='.$id.'');
   $_SESSION['Access_token']=$access_token;
   $_SESSION['Refresh_token']=$refresh_token;
}
    else{
        $err = curl_error($ch);
        echo $err;
    }
   
    curl_close($ch);   
}
    else{
        $err = curl_error($ch);
        echo $err;
    }
    

    curl_close($ch);
    
}
else{
    $client_id='a40cdd23faf144fd877e567a8ecf0ede';
    $client_secret='2775df12d322a52201f15e7771456d86';
    $grant_type='authorization_code';
    $user=$_SESSION['authUser'];
    $id=$_SESSION['authUserID'];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.1up.health/user-management/v1/user/auth-code');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'app_user_id='.$id.'&client_id='.$client_id.'&client_secret='.$client_secret.'');

    $result = curl_exec($ch);
    $response = json_decode($result);
    if($response->success==true){
        $response_code = $response->code;
        // echo $response_code;die;

     $code_query=sqlStatement("UPDATE users SET code='".$response_code."' where id ='$id'");
    // Access Token

    $id=$_SESSION['authUserID'];
            
    $sql=sqlQuery('SELECT code FROM users WHERE id='.$id.'');
    $new_code=$sql['code'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://auth.1up.health/oauth2/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'client_id='.$client_id.'&client_secret='.$client_secret.'&code='.$new_code.'&grant_type='.$grant_type.'');
    $result1 = curl_exec($ch);
    
    $response1=json_decode($result1);
    // echo $response1->access_token;die;
    if(!empty($response1->access_token)){
        $refresh_token=$response1->refresh_token;
    
        $access_token=$response1->access_token; 
        // print_r($access_token);

    $token_query=sqlStatement("UPDATE users SET access_token='".$access_token."',refresh_token='".$refresh_token."' where id ='$id'");
    $_SESSION['Access_token']=$access_token;
    $_SESSION['Refresh_token']=$refresh_token;  
    }
    else{
        $err = curl_error($ch);
        echo $err;
    }
    
    curl_close($ch);
 }
    else{
        $err = curl_error($ch);
        echo $err;
    }

    curl_close($ch);

}
  }
// end of getting access token

else{
  $query=$resource;
  // print_r($query);die;
  $id=$_SESSION['authUserID']; 
  $query_data=sqlQuery("SELECT access_token from users where id='$id'");
  // echo"<pre>";print_r($query_new);die;
        $conversion = implode(',', $query_data);
        $access_token = str_replace(',',' ', $conversion);

    
            $oneup_id="";
            $fname="";
            $lname="";
         
            $title=$query[0]?$query[0]:"0";
         
            $fname=$query[1]?$query[1]:"0";
            $mname=$query[2]?$query[2]:"0";
            $lname=$query[3]?$query[3]:"0";
            $name_suffix=$query[4]?$query[4]:"0";
            $birth_fname=$query[5]?$query[5]:"0";
            $birth_mname=$query[6]?$query[6]:"0";
            $birth_lname=$query[7]?$query[7]:"0";
            $dob=$query[8]?$query[8]:"0";
            $gender=$query[9]?$query[9]:"0";
            $gender_identity=$query[10]?$query[10]:"0";
            $sexual_orientation=$query[11]?$query[11]:"0";
            $external_id=$query[12]?$query[12]:"0";
            $ss_no=$query[13]?$query[13]:"0";
            $license=$query[14]?$query[14]:"0";
            $marital_status=$query[15]?$query[15]:"0";
            $genericname1=$query[16]?$query[16]:"0";
            $genericval1=$query[17]?$query[17]:"0";
            $genericname2=$query[18]?$query[18]:"0";
            $genericval2=$query[19]?$query[19]:"0";
            $billing_note=$query[20]?$query[20]:"0";
            $address1=$query[21]?$query[21]:"0";
            $address2=$query[22]?$query[22]:"0";
            $city=$query[23]?$query[23]:"0";
            $state=$query[24]?$query[24]:"0";
            $postal_code=$query[25]?$query[25]:"0";
            $country2=$query[26]?$query[26]:"0";
            $country1=$query[27]?$query[27]:"0";
            $mothers_name=$query[28]?$query[28]:"0";
            $emergency_contact=$query[29]?$query[29]:"0";
            $emergency_phone=$query[30]?$query[30]:"0";
            $phone_home=$query[31]?$query[31]:"0";
            $phone_work=$query[32]?$query[32]:"0";
            $cell=$query[33]?$query[33]:"0";
            $emergency_email=$query[34]?$query[34]:"0";
            $trust_email=$query[35]?$query[35]:"0";
            $providerID=$query[36]?$query[36]:"0";
            $provider_since_date=$query[37]?$query[37]:"0";
            $ref_providerID=$query[38]?$query[38]:"0";
            $pharmacy_id=$query[39]?$query[39]:"0";
            $hipaa_notice=$query[40]?$query[40]:"0";
            $hipaa_voice=$query[41]?$query[41]:"0";
            $hipaa_message=$query[42]?$query[42]:"0";
            $hipaa_mail=$query[43]?$query[43]:"0";
            $hipaa_allowsms=$query[44]?$query[44]:"0";
            $hipaa_allowemail=$query[45]?$query[45]:"0";
            $allow_imm_reg_use=$query[46]?$query[46]:"0";
            $allow_imm_info_share=$query[47]?$query[47]:"0";
            $allow_health_info_ex=$query[48]?$query[48]:"0";
            $allow_patient_portal=$query[49]?$query[49]:"0";
            $cmsportal_login=$query[50]?$query[50]:"0";
            $imm_reg_status=$query[51]?$query[51]:"0";
            $imm_reg_stat_effdate=$query[52]?$query[52]:"0";
            $publicity_code=$query[53]?$query[53]:"0";
            $publ_code_eff_date=$query[54]?$query[54]:"0";
            $protect_indicator=$query[55]?$query[55]:"0";
            $prot_indi_effdate=$query[56]?$query[56]:"0";
            $care_team_status=$query[57]?$query[57]:"0";
            $occupation=$query[58]?$query[60]:"0";
            $industry=$query[59]?$query[59]:"0";
            $language=$query[60]?$query[60]:"0";
            $financial_review=$query[62]?$query[62]:"0";
            $family_size=$query[61]?$query[61]:"0";
            $monthly_income=$query[63]?$query[63]:"0";
            $homeless=$query[64]?$query[64]:"0";
            $interpretter=$query[65]?$query[65]:"0";
            $migrantseasonal=$query[66]?$query[66]:"0";
            $referral_source=$query[67]?$query[67]:"0";
            $vfc=$query[68]?$query[68]:"0";
            $religion=$query[69]?$query[69]:"0";
            $deceased_date=$query[70]?$query[70]:"0";
            $deceased_reason=$query[71]?$query[71]:"0";
            $guardiansname=$query[72]?$query[72]:"0";
            $guardianrelationship=$query[73]?$query[73]:"0";
            $guardiansex=$query[74]?$query[74]:"0";
            $guardianaddress=$query[75]?$query[75]:"0";
            $guardiancity=$query[76]?$query[76]:"0";
            $guardianstate=$query[77]?$query[77]:"0";
            $guardianpostalcode=$query[78]?$query[78]:"0";
            $guardiancountry=$query[79]?$query[79]:"0";
            $guardianphone=$query[80]?$query[80]:"0";
            $guardianworkphone=$query[81]?$query[81]:"0";
            $guardianemail=$query[82]?$query[82]:"0";
            $pid=$query[83]?$query[83]:"0";

               // print_r($fname."|".$lname."|".$mname."|".$dob."|".$gender."|".$marital_status."|".$postal_code."|".$address1."|".$address2."|".$country."|".$state."|".$city."|".$phone_contact."|".$phone_home."|".$cell."|".$phone_biz."|".$emergency_email."|".$trust_email);die;

    $query_data=sqlQuery("SELECT access_token from users where id='$id'");
    $conversion = implode(',', $query_data);
    // $access_token = str_replace(',',' ', $conversion);
    $access_token=$_SESSION["Access_token"];
    // print_r($access_token);die;
        $json='{
          "resourceType": "Patient",
          "id": "'.$fname.$lname.'",
        
          "language": "'.$language.'",
         
          "identifier": [
            {
              "type": {
                "coding": [
                  {
                    "system": "http://terminology.hl7.org/CodeSystem/v2-0203",
                    "code": "MB",
                    "display": "Member Number"
                  }
                ],
                "text": "An identifier for the insured of an insurance policy (this insured always has a subscriber), usually assigned by the insurance carrier."
              },
              "system": "https://www.upmchealthplan.com/fhir/memberidentifier",
              "value": "88800933501",
              "assigner": {
                "reference": "Organization/PayerOrganizationExample1",
                "display": "UPMC Health Plan"
              }
            }
          ],
          "active": true,
          "name": [
            {
              "given": [
                "'.$fname.'",
                "'.$mname.'",
                "'.$lname.'",        
                "'.$title.'"         
              ]
             
            }
          ],
          "telecom": [
            {
              "system": "emergency_contact",
              "value": "'.$emergency_contact.'",
              "rank": 1
            },
         
            {
              "system": "phone_home",
              "value": "'.$phone_home.'",
              "rank": 2
            },
            {
              "system": "cell",
              "value": "'.$cell.'",
              "rank": 3
            },
            {
              "system": "phone_business",
              "value": "'.$phone_work.'",
              "rank": 4
            },
       
            {
              "system": "emergency_email",
              "value": "'.$emergency_email.'",
              "rank": 5
            },
            {
              "system": "trusted_email",
              "value": "'.$trust_email.'",
              "rank": 6
            },
            {
                "system": "name_suffix",
                "value": "'.$name_suffix.'",
                "rank": 7
              },
              {
                "system": "birth_fname",
                "value": "'.$birth_fname.'",
                "rank": 8
              },
              {
                "system": "birth_mname",
                "value": "'.$birth_mname.'",
                "rank": 9
              },
              {
                "system": "birth_lname",
                "value": "'.$birth_lname.'",
                "rank": 10
              },
              {
                "system": "gender_identity",
                "value": "'.$gender_identity.'",
                "rank": 11
              },
              {
                "system": "sexual_orientation",
                "value": "'.$sexual_orientation.'",
                "rank": 12
              },
              {
                "system": "external_id",
                "value": "'.$external_id.'",
                "rank": 13
              },
              {
                "system": "ss",
                "value": "'.$ss_no.'",
                "rank": 14
              },
              {
                "system": "drivers_license",
                "value": "'.$license.'",
                "rank": 15
              },
         
              {
                "system": "genericname1",
                "value": "'.$genericname1.'",
                "rank": 16
              },
              {
                "system": "genericval1",
                "value": "'.$genericval1.'",
                "rank": 17
              },
              {
                "system": "genericname2",
                "value": "'.$genericname2.'",
                "rank": 18
              },
              {
                "system": "genericval2",
                "value": "'.$genericval2.'",
                "rank": 19
              },
              {
                "system": "billing_note",
                "value": "'.$billing_note.'",
                "rank": 20
              },
              {
                "system": "providerID",
                "value": "'.$providerID.'",
                "rank": 21
              },
              {
                "system": "provider_since_date",
                "value": "'.$provider_since_date.'",
                "rank": 22
              },
              {
                "system": "ref_providerID",
                "value": "'.$ref_providerID.'",
                "rank": 23
              },
              {
                "system": "pharmacy_id",
                "value": "'.$pharmacy_id.'",
                "rank": 24
              },
              {
                "system": "hipaa_notice",
                "value": "'.$hipaa_notice.'",
                "rank": 25
              },
              {
                "system": "hipaa_voice",
                "value": "'.$hipaa_voice.'",
                "rank": 26
              },
              {
                "system": "hipaa_message",
                "value": "'.$hipaa_message.'",
                "rank": 27
              },
              {
                "system": "hipaa_mail",
                "value": "'.$hipaa_mail.'",
                "rank": 28
              },
              {
                "system": "hipaa_allowsms",
                "value": "'.$hipaa_allowsms.'",
                "rank": 29
              },
              {
                "system": "hipaa_allowemail",
                "value": "'.$hipaa_allowemail.'",
                "rank": 30
              },
              {
                "system": "allow_imm_reg_use",
                "value": "'.$allow_imm_reg_use.'",
                "rank": 31
              },
              {
                "system": "allow_imm_info_share",
                "value": "'.$allow_imm_info_share.'",
                "rank": 32
              },
              {
                "system": "allow_health_info_ex",
                "value": "'.$allow_health_info_ex.'",
                "rank": 33
              },
              {
                "system": "allow_patient_portal",
                "value": "'.$allow_patient_portal.'",
                "rank": 34
              },
              {
                "system": "cmsportal_login",
                "value": "'.$cmsportal_login.'",
                "rank": 35
              },
              {
                "system": "imm_reg_status",
                "value": "'.$imm_reg_status.'",
                "rank": 36
              },
              {
                "system": "imm_reg_stat_effdate",
                "value": "'.$imm_reg_stat_effdate.'",
                "rank": 37
              },
              {
                "system": "publicity_code",
                "value": "'.$publicity_code.'",
                "rank": 38
              },
              {
                "system": "publ_code_eff_date",
                "value": "'.$publ_code_eff_date.'",
                "rank": 39
              },
              {
                "system": "protect_indicator",
                "value": "'.$protect_indicator.'",
                "rank": 40
              },
              {
                "system": "prot_indi_effdate",
                "value": "'.$prot_indi_effdate.'",
                "rank": 41
              },
              {
                "system": "care_team_status",
                "value": "'.$care_team_status.'",
                "rank": 42
              },
              {
                "system": "occupation",
                "value": "'.$occupation.'",
                "rank": 43
              },
              {
                "system": "industry",
                "value": "'.$industry.'",
                "rank": 44
              },
              {
                "system": "financial_review",
                "value": "'.$financial_review.'",
                "rank": 45
              },
              {
                "system": "family_size",
                "value": "'.$family_size.'",
                "rank": 46
              },
              {
                "system": "monthly_income",
                "value": "'.$monthly_income.'",
                "rank": 47
              },
              {
                "system": "homeless",
                "value": "'.$homeless.'",
                "rank": 48
              },
              {
                "system": "interpretter",
                "value": "'.$interpretter.'",
                "rank": 49
              },
              {
                "system": "migrantseasonal",
                "value": "'.$migrantseasonal.'",
                "rank": 50
              },
              {
                "system": "referral_source",
                "value": "'.$referral_source.'",
                "rank": 51
              },
              {
                "system": "vfc",
                "value": "'.$vfc.'",
                "rank": 52
              },
              {
                "system": "religion",
                "value": "'.$religion.'",
                "rank": 53
              },
              {
                "system": "deceased_date",
                "value": "'.$deceased_date.'",
                "rank": 54
              },
              {
                "system": "deceased_reason",
                "value": "'.$deceased_reason.'",
                "rank": 55
              },
              {
                "system": "guardiansname",
                "value": "'.$guardiansname.'",
                "rank": 56
              },
              {
                "system": "guardianrelationship",
                "value": "'.$guardianrelationship.'",
                "rank": 57
              },
              {
                "system": "guardiansex",
                "value": "'.$guardiansex.'",
                "rank": 58
              },
              {
                "system": "guardianaddress",
                "value": "'.$guardianaddress.'",
                "rank": 59
              },
              {
                "system": "guardiancity",
                "value": "'.$guardiancity.'",
                "rank": 60
              },
              {
                "system": "guardianstate",
                "value": "'.$guardianstate.'",
                "rank": 61
              },
              {
                "system": "guardianpostalcode",
                "value": "'.$guardianpostalcode.'",
                "rank": 62
              },
              {
                "system": "guardiancountry",
                "value": "'.$guardiancountry.'",
                "rank": 63
              },
              {
                "system": "guardianphone",
                "value": "'.$guardianphone.'",
                "rank": 64
              },
              {
                "system": "guardianworkphone",
                "value": "'.$guardianworkphone.'",
                "rank": 65
              },
              {
                "system": "guardianemail",
                "value": "'.$guardianemail.'",
                "rank": 66
              },
              {
                "system": "pid",
                "value": "'.$pid.'",
                "rank": 67
              },
              {
                "system": "country1",
                "value": "'.$country1.'",
                "rank": 68
              },
              {
                "system": "country2",
                "value": "'.$country2.'",
                "rank": 69
              },
  
              {
                "system": "mothers_name",
                "value": "'.$mothers_name.'",
                "rank": 70
              },
              {
                "system": "emergency_phone",
                "value": "'.$emergency_phone.'",
                "rank": 71
              }
          ],
          "gender": "'.$gender.'",
          "birthDate": "'.$dob.'",
          "address": [
            {
              "type": "physical",
              "line": [
                "'.$address1.'"
              ],
             
              "city": "'.$city.'",
              "state": "'.$state.'",
              "postalCode": "'.$postal_code.'"
            },
            {
              "type": "physical",
              "line": [
                "'.$address2.'"
              ],
              "city": "'.$city.'",
              "state": "'.$state.'",
              "postalCode": "'.$postal_code.'"
            }
          ],
          "maritalStatus": {
            "coding": [
              {
                "system": "http://terminology.hl7.org/CodeSystem/v3-NullFlavor",
                "code": "UNK"
              }
            ],
            "text": "'.$marital_status.'"
          },
          "communication": [
            {
              "language": {
                "coding": [
                  {
                    "system": "urn:ietf:bcp:47",
                    "code": "en"
                  }
                ],
                "text": "English"
              },
              "preferred": true
            }
          ],
          "managingOrganization": {
            "reference": "Organization/PayerOrganizationExample1",
            "display": "UPMC Health Plan"
          }
        }';
           
          
        
        //  print_r($json);die;
        // $json = json_encode($data);
        // echo "<pre>";print_r($json);die;
      
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, 'https://api.1up.health/dstu2/Patient');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
        
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer $access_token";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        // print_r($result);die;
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        else{
            $patient_id=json_decode($result);
            $response_id=$patient_id->id;
            $_SESSION['response_id']=$response_id;  
      
        }
        curl_close($ch);
        

          //get resource
    
          $id=$_SESSION['response_id'];
          $ch = curl_init();
          
          curl_setopt($ch, CURLOPT_URL, "https://api.1up.health/dstu2/Patient/$id");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
          
          
          $headers = array();
          $headers[] = "Authorization: Bearer $access_token";
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          
          $result = curl_exec($ch);
          // echo $result;die;
          if (curl_errno($ch)) {
              echo 'Error:' . curl_error($ch);
          }
          else{
            $response=json_decode($result);
            // echo $result;
            // echo substr_count($result,"rank");
            // echo $response->telecom[71]->value;
            // die;
            $oneup_id=$response->id;
            $fname=$response->name[0]->given[0];  
            // echo $fname;die;        
            $lname=$response->name[0]->given[2];            
            $mname=$response->name[0]->given[1];           
            $title=$response->name[0]->given[3];           
            $dob=$response->birthDate;           
            $gender=$response->gender;
            $postal_code=$response->address[0]->postalCode;
            $marital_status=$response->maritalStatus->text;
            $address1=$response->address[0]->line;
            $address2=$response->address[1]->line;
            $city=$response->address[0]->city;           
            $emergency_contact=$response->telecom[0]->value;
            $phone_home=$response->telecom[1]->value;
            $cell=$response->telecom[2]->value;
            $phone_work=$response->telecom[3]->value;
            $emergency_email=$response->telecom[4]->value;
            $trust_email=$response->telecom[5]->value;
            $name_suffix=$response->telecom[6]->value;
            $birth_fname=$response->telecom[7]->value;
            $birth_mname=$response->telecom[8]->value;
            $birth_lname=$response->telecom[9]->value;
            $gender_identity=$response->telecom[10]->value;
            $sexual_orientation=$response->telecom[11]->value;
            $external_id=$response->telecom[12]->value;
            $ss_no=$response->telecom[13]->value;
            $license=$response->telecom[14]->value;
            $genericname1=$response->telecom[15]->value;
            $genericval1=$response->telecom[16]->value;
            $genericname2=$response->telecom[17]->value;
            $genericval2=$response->telecom[18]->value;
            $billing_note=$response->telecom[19]->value;
            $providerID=$response->telecom[20]->value;
            $provider_since_date=$response->telecom[21]->value;
            $ref_providerID=$response->telecom[22]->value;
            $pharmacy_id=$response->telecom[23]->value;
            $hipaa_notice=$response->telecom[24]->value;
            $hipaa_voice=$response->telecom[25]->value;
            $hipaa_message=$response->telecom[26]->value;
            $hipaa_mail=$response->telecom[27]->value;
            $hipaa_allowsms=$response->telecom[28]->value;
            $hipaa_allowemail=$response->telecom[29]->value;
            $allow_imm_reg_use=$response->telecom[30]->value;
            $allow_imm_info_share=$response->telecom[31]->value;
            $allow_health_info_ex=$response->telecom[32]->value;
            $allow_patient_portal=$response->telecom[33]->value;
            $cmsportal_login=$response->telecom[34]->value;
            $imm_reg_status=$response->telecom[35]->value;
            $imm_reg_stat_effdate=$response->telecom[36]->value;
            $publicity_code=$response->telecom[37]->value;
            $publ_code_eff_date=$response->telecom[38]->value;
            $protect_indicator=$response->telecom[39]->value;
            $prot_indi_effdate=$response->telecom[40]->value;
            $care_team_status=$response->telecom[41]->value;
            $occupation=$response->telecom[42]->value;
            $industry=$response->telecom[43]->value;
            $language=$response->language;
            $financial_review=$response->telecom[44]->value;
            $family_size=$response->telecom[45]->value;
            $monthly_income=$response->telecom[46]->value;
            $homeless=$response->telecom[47]->value;
            $interpretter=$response->telecom[48]->value;
            $migrantseasonal=$response->telecom[49]->value;
            $referral_source=$response->telecom[50]->value;
            $vfc=$response->telecom[51]->value;
            $religion=$response->telecom[52]->value;
            $deceased_date=$response->telecom[53]->value;
            $deceased_reason=$response->telecom[54]->value;
            // print_r($deceased_reason);die;
            $guardiansname=$response->telecom[55]->value;
            $pid=$response->telecom[68]->value;
          
      
            if($title=="0"){
              $title="";
            }
            if($fname=="0"){
              $fname="";
            }
            if($lname=="0"){
                $lname="";
              }
              if($mname=="0"){
                $mname="";
              }
              if($name_suffix=="0"){
                $name_suffix="";
              }
              if($birth_fname=="0"){
                $birth_fname="";
              }
              if($birth_lname=="0"){
                $birth_lname="";
              }
              if($birth_mname=="0"){
                $birth_mname="";
              }
              if($dob=="0"){
                $dob="";
              }
              if($gender=="0"){
                $gender="";
              }
              if($gender_identity=="0"){
                $gender_identity="";
              }
              if($sexual_orientation=="0"){
                $sexual_orientation="";
              }
              if($external_id=="0"){
                $external_id="";
              }
              if($ss_no=="0"){
                $ss_no="";
              } 
              if($license=="0"){
                $license="";
              } 
              if($billing_note=="0"){
                $billing_note="";
              } 
              if($genericname1=="0"){
                $genericname1="";
              }
              if($genericval1=="0"){
                $genericval1="";
              }
              if($genericname2=="0"){
                $genericname2="";
              }
              if($genericval2=="0"){
                $genericname1="";
              }
              if($postal_code=="0"){
                $postal_code="";
              }
              if($marital_status=="0"){
                $marital_status="";
              }
              if($address1=="0"){
                $address1="";
              }
              if($address2=="0"){
                $address2="";
              }
              if($city=="0"){
                $city="";
              }
              if($state=="0"){
                $state="";
              }
              if($country1=="0"){
                $country1="";
              }
              if($country2=="0"){
                $country2="";
              }
              if($emergency_contact=="0"){
                $emergency_contact="";
              }
              if($emergency_phone=="0"){
                $emergency_phone="";
              }
              if($phone_home=="0"){
                $phone_home="";
              }
              if($phone_work=="0"){
                $phone_work="";
              }
              if($cell=="0"){
                $cell="";
              }
              if($emergency_email=="0"){
                $emergency_email="";
              }
              if($trust_email=="0"){
                $trust_email="";
              }
              if($providerID=="0"){
                $providerID="";
              }
              if($provider_since_date=="0"){
                $provider_since_date="";
              }
              if($ref_providerID=="0"){
                $ref_providerID="";
              }
              if($pharmacy_id=="0"){
                $pharmacy_id="";
              }
              if($hipaa_notice=="0"){
                $hipaa_notice="";
              }
              if($hipaa_voice=="0"){
                $hipaa_voice="";
              }
              if($hipaa_message=="0"){
                $hipaa_message="";
              }
              if($hipaa_mail=="0"){
                $hipaa_mail="";
              }
              if($hipaa_allowemail=="0"){
                $hipaa_allowemail="";
              }
              if($hipaa_allowsms=="0"){
                $hipaa_allowsms="";
              }
              if($allow_imm_reg_use=="0"){
                $allow_imm_reg_use="";
              }
              if($allow_health_info_ex=="0"){
                $allow_health_info_ex="";
              }
              if($allow_imm_info_share=="0"){
                $allow_imm_info_share="";
              }
              if($allow_patient_portal=="0"){
                $allow_patient_portal="";
              }
              if($cmsportal_login=="0"){
                $cmsportal_login="";
              }
              if($imm_reg_stat_effdate=="0"){
                $imm_reg_stat_effdate="";
              }
              if($imm_reg_status=="0"){
                $imm_reg_status="";
              }
              if($publicity_code=="0"){
                $publicity_code="";
              }
              if($publ_code_eff_date=="0"){
                $publ_code_eff_date="";
              }
              if($protect_indicator=="0"){
                $protect_indicator="";
              }
              if($prot_indi_effdate=="0"){
                $prot_indi_effdate="";
              }
              if($care_team_status=="0"){
                $care_team_status="";
              }
              if($occupation=="0"){
                $occupation="";
              }
              if($industry=="0"){
                $industry="";
              }
              if($financial_review=="0"){
                $financial_review="";
              }
              if($family_size=="0"){
                $family_size="";
              }
              if($monthly_income=="0"){
                $monthly_income="";
              }
              if($interpretter=="0"){
                $interpretter="";
              }
              if($migrantseasonal=="0"){
                $migrantseasonal="";
              }
              if($homeless=="0"){
                $homeless="";
              }
              if($referral_source=="0"){
                $referral_source="";
              }
              if($religion=="0"){
                $religion="";
              }
              if($deceased_date=="0"){
                $deceased_date="";
              }
              if($deceased_reason=="0"){
                $deceased_reason="";
              }
              if($guardiansname=="0"){
                $guardiansname="";
              }
              if($guardianrelationship=="0"){
                $guardianrelationship="";
              }
              if($guardiansex=="0"){
                $guardiansex="";
              }
              if($guardianaddress=="0"){
                $guardianaddress="";
              }
              if($guardiancity=="0"){
                $guardiancity="";
              }
              if($guardiancountry=="0"){
                $guardiancountry="";
              }
              if($guardianstate=="0"){
                $guardianstate="";
              }
              if($guardianphone=="0"){
                $guardianphone="";
              }
              if($guardianworkphone=="0"){
                $guardianworkphone="";
              }
              if($pid=="0"){
                $pid="";
              }
              if($country1=="0"){
                $country1="";
              }
              if($country2=="0"){
                $country="";
              }
        
              if($guardianemail=="0"){
                $guardianemail="";
              }
              if($guardianemail=="0"){
                $guardianemail="";
              }
              if($guardianemail=="0"){
                $guardianemail="";
              }
          
          }
          curl_close($ch);
      
        
       

      $address_first=$address1[0];
      $address_second=$address2[0];

        $api_data=[
        0=>$title,
        1=>$fname,
        2=>$mname,
        3=>$lname,
        4=>$name_suffix,
        5=>$birth_fname,
        6=>$birth_mname,
        7=>$birth_lname,
        8=>$dob,
        9=>$gender,
        10=>$gender_identity,
        11=>$sexual_orientation,
        12=>$external_id,
        13=>$ss_no,
        14=>$license,
        15=>$marital_status,
        16=>$genericname1,
        17=>$genericval1,
        18=>$genericname2,
        19=>$genericval2,
        20=>$billing_note,
        21=>$address_first,
        22=>$address_second,
        23=>$city,
        24=>$state,
        25=>$postal_code,
        26=>$country2,
        27=>$country1,
        28=>$mothers_name,
        29=>$emergency_contact,
        30=>$emergency_phone,
        31=>$phone_home,
        32=>$phone_work,
        33=>$cell,
        34=>$emergency_email,
        35=>$trust_email,
        36=>$providerID,
        37=>$provider_since_date,
        38=>$ref_providerID,
        39=>$pharmacy_id,
        40=>$hipaa_notice,
        41=>$hipaa_voice,
        42=>$hipaa_message,
        43=>$hipaa_mail,
        45=>$hipaa_allowemail,
        44=>$hipaa_allowsms,
        46=>$allow_imm_reg_use,
        47=>$allow_imm_info_share,
        48=>$allow_health_info_ex,
        49=>$allow_patient_portal,
        50=>$cmsportal_login,
        51=>$imm_reg_status,
        52=>$imm_reg_stat_effdate,
        53=>$publicity_code,
        54=>$publ_code_eff_date,
        55=>$protect_indicator,
        56=>$prot_indi_effdate,
        57=>$care_team_status,
        58=>$occupation,
        59=>$industry,
        60=>$language,
        61=>$financial_review,
        62=>$family_size,
        63=>$monthly_income,
        64=>$homeless,
        65=>$interpretter,
        66=>$migrantseasonal,
        67=>$referral_source,
        68=>$vfc,
        69=>$religion,
        70=>$deceased_date,
        71=>$deceased_reason,
        72=>$guardiansname,
        73=>$guardianrelationship,
        74=>$guardiansex,
        75=>$guardianaddress,
        76=>$guardiancity,
        77=>$guardianstate,
        78=>$guardianpostalcode,
        79=>$guardiancountry,
        80=>$guardianphone,
        81=>$guardianworkphone,
        82=>$guardianemail,
        83=>$pid
        ];
    return $api_data;
        // api_data($api_data);
//end of get resource
}
}
// Task Manager
function addtask(){
  ?>
  <!-- ADD Task button line start -->
  <span class="mr-auto" style="position: absolute;top: 50px;right: 625px;">
      <a class="btn btn-success btn-sm font-weight-bold" href="#" data-bind="click: viewAddTask"
          title="<?php echo xla("Task Manager"); ?>">
          <i class="fa-solid fa-plus"></i>&nbsp;&nbsp; ADD TASK
      </a>
  </span> 
      
  <!-- ADD Task button line end -->
  <?php
}

//Time Tracker
function time_tracker(){
 ?>
<div class="over_all d-none">

        <div id="time">
            <span class="digit" id="hr">
            00</span>
            <span class="txt">:</span>
            <span class="digit" id="min">
            00</span>
            <span class="txt">:</span>
            <span class="digit" id="sec">
            00</span>
        </div>
        <div id="buttons">
            <button class="btns" id="start">
            <i class="fa fa-pause" id="icon"></i></button>
        </div>
    </div>
    <style>
        .over_all {
            position: absolute;
            top: 50px;
            right: 70px;
            /* display: none !important; */
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 164px;
            height: 50px;
            float:right;
            margin:-9px 70px 0px;
        }

        h1 {

            text-align: center;
        }

        .digit {
            font-size: 15px;
            font-weight: 500;
        }

        .txt {
            font-size: 15px;
            font-weight: 500;
        }



        .btns{
            width: 25px;
            padding: 0px 0px;
            margin: 0px 10px;
            border:none;
            border-radius:5px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.5s;
            color: white;
            font-weight: 500;
        }

        #start {
            background-color: #28a745;
        }
       
    </style>
    <script>
            var call_count="";
        var repeat="";
        var temp_pid=[];
        var temp="";
    function timer_func(e){
        var hour = 00;    
        var minute = 00;
        var second = 00;
        var count = 00;
        var startBtn = document.getElementById('start');
        var icon = document.getElementById('icon');
        var timer_div = document.querySelector('.over_all');
        var new_pid=sessionStorage.getItem("pid");
        temp_pid.push(new_pid);
        if(temp_pid.length>1){
            temp = temp_pid[0];
            temp_pid.shift();     
        }
            if(e){

                var hours= document.getElementById('hr').innerHTML;
                var minutes=document.getElementById('min').innerHTML;
                var seconds=document.getElementById('sec').innerHTML;
                var new_patient=sessionStorage.getItem("unique_id");
                $('#start').unbind('click');
                $.ajax({
                    method:'POST',
                    url:webroot_url+"/interface/customized/time_tracker/time_tracker.php?duration",
                    data:{hours:hours,minutes:minutes,seconds:seconds,new_patient:new_patient},
                    success:function(response)
                    {
                    
                    }
                });
                if(timer_div.classList.contains("d-flex") || startBtn.classList.contains("newclass") || icon.classList.contains("fa-play")){
                    timer_div.classList.remove("d-flex");
                    timer_div.classList.add("d-none");
                    startBtn.classList.remove("newclass");
                    icon.classList.remove("fa-play");
                    icon.classList.add("fa-pause");
                }
                clearTimeout(repeat);
                sessionStorage.removeItem("pid");
            }
            else{
                if(temp=='' || new_pid!=temp){  
                    if(icon.classList.contains("fa-play") || startBtn.classList.contains("newclass")){
                        icon.classList.remove("fa-play");
                        icon.classList.add("fa-pause");
                        startBtn.classList.remove("newclass");
                    }
                    if(temp!=''){
                        var hours= document.getElementById('hr').innerHTML;
                        var minutes=document.getElementById('min').innerHTML;
                        var seconds=document.getElementById('sec').innerHTML;
                        var new_patient=sessionStorage.getItem("unique_id");
                        // alert(hours);
                        $.ajax({
                            method:'POST',
                            url:webroot_url+"/interface/customized/time_tracker/time_tracker.php?duration",
                            data:{
                                hours:hours,
                                minutes:minutes,
                                seconds:seconds,
                                new_patient:new_patient
                            },
                            success:function(response)
                            {
                                // alert(response);
                            }
                        });
                    }
                    $("#start").unbind("click"); 
                    clearTimeout(repeat);
                    new_time();
                }else{
                    clearTimeout(repeat);
                    return false;
                }
             function new_time(){
                $.ajax({
                    method:'POST',
                    url:webroot_url+"/interface/customized/time_tracker/time_tracker.php?tracker",
                    data:{},
                    success:function(response)
                    {
                        // alert(response);
                        sessionStorage.setItem("unique_id",response);
                    
                    }
                });

                if(timer_div.classList.contains("d-none")){
                    timer_div.classList.remove("d-none");
                    timer_div.classList.add("d-flex");
                }

                timer=true;
                stopWatch();

                $('#start').bind('click', function () {
                if(startBtn.classList.contains("newclass"))
                {
                    timer=true;
                    stopWatch();
                    startBtn.classList.remove("newclass");
                    icon.classList.remove("fa-play");
                    icon.classList.add("fa-pause");
                    
                }
                else{
                    timer=false;
                    startBtn.classList.add("newclass");
                    icon.classList.remove("fa-pause");
                    icon.classList.add("fa-play");
                    clearTimeout(repeat);
                    return false;
                }  
                });
                function stopWatch() {
                if (timer) {
                    count++;

                    if (count == 100) {
                        second++;
                        count = 0;
                    }

                    if (second == 60) {
                        minute++;
                        second = 0;
                    }

                    if (minute == 60) {
                        hour++;
                        minute = 0;
                        second = 0;
                    }

                    var hrString = hour;
                    var minString = minute;
                    var secString = second;
                    var countString = count;

                    if (hour < 10) {
                        hrString = "0" + hrString;
                    }

                    if (minute < 10) {
                        minString = "0" + minString;
                    }

                    if (second < 10) {
                        secString = "0" + secString;
                    }

                    if (count < 10) {
                        countString = "0" + countString;
                    }

                    document.getElementById('hr').innerHTML = hrString;
                    document.getElementById('min').innerHTML = minString;
                    document.getElementById('sec').innerHTML = secString;
                    repeat= setTimeout(stopWatch, 10);
                    
                }
                }
                }
                }
            }
    </script>
<?php
}
?>
<!-- Phone Integration -->
<?php
function phone(){
?>
<div class="phone">
<i class="fa fa-phone call" id="myBtn" style="font-size:15px;padding:5px"></i>
<i class="fa fa-envelope chat" style="font-size:15px;padding:5px"></i>
<i class="fa fa-video-camera video" style="font-size:15px;padding:5px"></i>
</div>
    <!-- The Modal -->
<div id="myModal" class="modal_div">

<!-- Modal content -->
<div class="modal-content_div">
<span class="close">&times;</span>
<div class="form-group">
<label for="callee_number">Callee Number&ensp;<small class="phone_div"></small></label>
<input type="text" for="callee_number" id="callee_no" class="form-control callee_no" required>
<div class="alert_div" style="color:red"></div>
<br>
<div class="btn-group justify-content-end">
<button class="btn btn-danger cancel">Cancel</button>&nbsp;<button class="btn btn-primary submit">Submit</button>
</div>

</div>
</div>
</div>
<!-- modal end -->
<!-- The Modal for Chat -->
<div id="chatmodal" class="modal_div">
<!-- Modal content -->
<div class="modal-content_div">
<span class="close1">&times;</span>
<div class="form-group">
<label for="to">To&ensp;  <small class="phone_div1"></small></label>
<input type="text" for="to" id="to" class="form-control to" required>
<div class="alert_div" style="color:red"></div>
<label for="msg">Message</label>
<textarea for="msg" id="msg" class="form-control msg" required></textarea>
<div class="alert_div" style="color:red"></div>
<br>
<div class="btn-group justify-content-end">
<button class="btn btn-danger cancel1">Cancel</button>&nbsp;<button class="btn btn-primary submit1">Submit</button>
</div>

</div>
</div>
</div>
<!-- modal end -->
<!-- The Modal for Chat -->
<div id="newmodal" class="modal">
<!-- Modal content -->
<div class="modal-content new_modal">
<span class="close1">&times;</span>
</div>
</div>
<!-- modal end -->
<script>
    $(".submit").on("click",()=>{
      var callee_no=$("#callee_no").val();
      if(callee_no==""){
        $(".alert_div").html("*This Field is Required");
      }
      else{
      $("#myModal").css("display","none");
      $.ajax({
            method:'POST',
            url:webroot_url+"/interface/customized/phone/phone.php?call",
            data:{callee_no:callee_no},
            success:function(response)
              {
            $("#callee_no").val("");
            if(response=="success"){      
            window.open('https://my.phone.com/e2352112/calls/cc086ada0-d474-11ed-baaa-713464e3ddd3%7C642eb8163df8085c353a7763');
              }
              else{
                alert("Error");
                $("#callee_no").val("");
              }
            }
           });
          }
        });

        $(".cancel").on("click",()=>{
            clear();
          $("#myModal").css("display","none");
        });
        $(".close").on("click",()=>{
            clear();
            $("#chatmodal").css("display","none");
        })
        $(".submit1").on("click",()=>{
        var to=$("#to").val();
        var msg=$("#msg").val();
      if(to=="" || msg==""){
        $(".alert_div").html("*This Field is Required");
      }
      else{
      $("#chatmodal").css("display","none");
      $.ajax({
            method:'POST',
            url:webroot_url+"/interface/customized/phone/phone.php?chat",
            data:{to:to,msg:msg},
            success:function(response)
              {
            if(response=="success"){        
            alert("Message has been Sent!");
            $("#to").val("");
            $("#msg").val("");

              }
              else{
                alert("Message Sent Failed");
                $("#to").val("");
                $("#msg").val("");

              }
            }
           });
          }
        });

        $(".cancel1").on("click",()=>{
            clear();
          $("#chatmodal").css("display","none");
        });
        $(".close1").on("click",()=>{
            clear();
            $("#chatmodal").css("display","none");
        })
        function clear(){
            $('#callee_no').val('');
            $('#to').val('');
            $('#msg').val('');
            $(".phone_div").html('');
            $(".phone_div1").html('');
        }
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

$(".call").on("click",()=>{
    $.ajax({
            method:'POST',
            url:webroot_url+"/interface/customized/phone/phone.php?check_call",
            data:{},
            success:function(response)
         
              {
                if(response=="empty"){
                    alert("Choose the Patient to Continue");
                }
                else{
                    $("#myModal").css("display","block");
                  
                    if(response==""){
                        $(".phone_div").html("*The Patient does not have Mobile number");
                        $(".phone_div").css("color","red");
                        $("#callee_no").css("border-color","red");
                    }
                    else{
                        $("#callee_no").val(response);
                        $(".phone_div").html("");
                        $("#callee_no").css("border-color","#ccc");
                    }
                }     
               
              }
           });
});

$(".chat").on("click",()=>{
    $.ajax({
            method:'POST',
            url:webroot_url+"/interface/customized/phone/phone.php?check_chat",
            data:{},
            success:function(response)
              {
                if(response=="empty"){
                    alert("Choose the Patient To Continue");
                }
                else{
                    $("#chatmodal").css("display","block");
                    if(response==""){
                        $(".phone_div1").html("*The Patient Does not have Mobile number");
                        $(".phone_div1").css("color","red");
                        $("#to").css("border-color","red");
                    }
                    else{
                        $("#to").val(response);
                        $(".phone_div1").html("");
                        $("#to").css("border-color","#ccc");
                    }
                }     
               
              }
           });
});
$(".video").on("click",()=>{
    $.ajax({
            method:'POST',
            url:webroot_url+"/interface/customized/phone/phone.php?check_video",
            data:{},
            success:function(response)
              {
                if(response=="empty"){
                    alert("Choose the Patient To Continue");
                }
                else{
                    // $("#newmodal").css("display","block");
                    // $(".new_modal").open("https://brokers.meet.phone.com/conf/call/6299096");                 
                     window.open("https://brokers.meet.phone.com/conf/call/6299096","","width=400,height=500,top=200,left=450");
                }     
               
              }
           });
});


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
<style>
     .phone{
            position: absolute;
            top: 62px;
            right: 91px;
            margin:-9px 200px 0px 0px;
        }
        /* The Modal (background) */
        .modal_div {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content_div {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        }

        /* The Close Button */
        .close {
        color: #aaaaaa;
        text-align: right;
        font-size: 28px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
        .btn-group{
        text-align:right!important;
        }
        .close1{
        color: #aaaaaa;
        text-align: right;
        font-size: 28px;
        font-weight: bold;  
        float: right;
        }
        .close1:hover,
        .close1:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
        }
</style>

<?php
}

