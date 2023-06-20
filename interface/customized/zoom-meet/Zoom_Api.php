<?php 
/* 
| Developed by: Tauseef Ahmad
| Last Upate: 01-19-2021 08:45 PM
| Facebook: www.facebook.com/ahmadlogs
| Twitter: www.twitter.com/ahmadlogs
| YouTube: https://www.youtube.com/channel/UCOXYfOHgu-C-UfGyDcu5sYw/
| Blog: https://ahmadlogs.wordpress.com/
 */ 
 
//Include Firebase Library and Dependencies
namespace OpenEMR\Services;
require_once 'php-jwt-master/src/BeforeValidException.php';
require_once 'php-jwt-master/src/ExpiredException.php';
require_once 'php-jwt-master/src/SignatureInvalidException.php';
require_once 'php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;


class Zoom_Api
{
	private $zoom_api_key = 'izqtfXm3S8OtteQHp3Qa5w';
	private $zoom_api_secret = 'ail0sDkonHZvHreT3hqP2R7XGNWjRu8dN3GS';	
	
	//function to generate JWT
	private function generateJWTKey() {
		$key = $this->zoom_api_key;
		$secret = $this->zoom_api_secret;
		$token = array(
			"iss" => $key,
			"exp" => time() + 3600 //60 seconds as suggested
		);
		return JWT::encode( $token, $secret );
	}	
	
	//function to create meeting
    	public function createMeeting($data = array())
    	{
		$post_time  = $data['start_date'];
		$start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));
		
		$createMeetingArray = array();
		if (!empty($data['alternative_host_ids'])) {
		    if (count($data['alternative_host_ids']) > 1) {
			$alternative_host_ids = implode(",", $data['alternative_host_ids']);
		    } else {
			$alternative_host_ids = $data['alternative_host_ids'][0];
		    }
		}


		$createMeetingArray['topic']      = $data['topic'];
		$createMeetingArray['agenda']     = !empty($data['agenda']) ? $data['agenda'] : "";
		$createMeetingArray['type']       = !empty($data['type']) ? $data['type'] : 2; //Scheduled
		$createMeetingArray['start_time'] = $start_time;
		$createMeetingArray['timezone']   = 'Asia/Kolkata';
		$createMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
		$createMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;

		$createMeetingArray['settings']   = array(
            		'join_before_host'  => !empty($data['join_before_host']) ? true : false,
            		'host_video'        => !empty($data['option_host_video']) ? true : false,
            		'participant_video' => !empty($data['option_participants_video']) ? true : false,
            		'mute_upon_entry'   => !empty($data['option_mute_participants']) ? true : false,
            		'enforce_login'     => !empty($data['option_enforce_login']) ? true : false,
            		'auto_recording'    => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
            		'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        	);

		return $this->sendRequest($createMeetingArray);
	}	
	//function to send request
	protected function sendRequest($data)
	{
	//Enter_Your_Email
	$request_url = "https://api.zoom.us/v2/users/karthi@capminds.com/meetings";
	
	$headers = array(
		"authorization: Bearer ".$this->generateJWTKey(),
		"content-type: application/json",
		"Accept: application/json",
	);
	//echo $request_url;
	$postFields = json_encode($data);
	if  (in_array  ('curl', get_loaded_extensions())) {
		// echo "cURL is installed on this server";
	}
	else {
		echo "cURL is not installed on this server";
	}
	//echo '<pre>';print_r($postFields);exit();
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $request_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		//CURLOPT_HTTP_VERSION =>CURL_HTTP_VERSION_2TLS,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $postFields,
		CURLOPT_HTTPHEADER => $headers,
		));

		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if (empty($response)) {
				return $err;
	}
		return json_decode($response);
}
	public function updateMeeting($data = array(),$meeting_id)
    	{
		$post_time  = $data['start_date'];
		$start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));

		$createMeetingArray = array();
		if (!empty($data['alternative_host_ids'])) {
		    if (count($data['alternative_host_ids']) > 1) {
			$alternative_host_ids = implode(",", $data['alternative_host_ids']);
		    } else {
			$alternative_host_ids = $data['alternative_host_ids'][0];
		    }
		}


		$createMeetingArray['topic']      = $data['topic'];
		$createMeetingArray['agenda']     = !empty($data['agenda']) ? $data['agenda'] : "";
		$createMeetingArray['type']       = !empty($data['type']) ? $data['type'] : 2; //Scheduled
		$createMeetingArray['start_time'] = $start_time;
		$createMeetingArray['timezone']   = 'Asia/Kolkata';
		$createMeetingArray['password']   = !empty($data['password']) ? $data['password'] : "";
		$createMeetingArray['duration']   = !empty($data['duration']) ? $data['duration'] : 60;

		$createMeetingArray['settings']   = array(
            		'join_before_host'  => !empty($data['join_before_host']) ? true : false,
            		'host_video'        => !empty($data['option_host_video']) ? true : false,
            		'participant_video' => !empty($data['option_participants_video']) ? true : false,
            		'mute_upon_entry'   => !empty($data['option_mute_participants']) ? true : false,
            		'enforce_login'     => !empty($data['option_enforce_login']) ? true : false,
            		'auto_recording'    => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
            		'alternative_hosts' => isset($alternative_host_ids) ? $alternative_host_ids : ""
        	);

		return $this->sendRequest1($createMeetingArray,$meeting_id);
	}	

	protected function sendRequest1($data,$meeting_id)
    	{
		//Enter_Your_Email
		$request_url = "https://api.zoom.us/v2/meetings/".$meeting_id;
		
		$headers = array(
			"authorization: Bearer ".$this->generateJWTKey(),
			"content-type: application/json",
			"Accept: application/json",
		);
		
		$postFields = json_encode($data);
		
        	$ch = curl_init();
        	curl_setopt_array($ch, array(
            	CURLOPT_URL => $request_url,
	    	CURLOPT_RETURNTRANSFER => true,
	    	CURLOPT_ENCODING => "",
	    	CURLOPT_MAXREDIRS => 10,
	    	CURLOPT_TIMEOUT => 30,
	    	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    	CURLOPT_CUSTOMREQUEST => "PATCH",
	    	CURLOPT_POSTFIELDS => $postFields,
	    	CURLOPT_HTTPHEADER => $headers,
        	));

        	$response = curl_exec($ch);
        	$err = curl_error($ch);
        	curl_close($ch);
	if (empty($response)) {
            		return $err;
		}
        	return json_decode($response);
	}
	


	public function GetMeetingList($data = array())
				{
				//Enter_Your_Email
				$request_url = "https://api.zoom.us/v2/users/karthi@capminds.com/meetings";

				$headers = array(
					"authorization: Bearer ".$this->generateJWTKey(),
					"content-type: application/json",
					"Accept: application/json",
				);

				$postFields = json_encode($data);

					$ch = curl_init();
					curl_setopt_array($ch, array(
						CURLOPT_URL => $request_url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_POSTFIELDS => $postFields,
					CURLOPT_HTTPHEADER => $headers,
					));

					$response = curl_exec($ch);
					$err = curl_error($ch);
					curl_close($ch);
					if (!$response) {
							return $err;
				}
					return json_decode($response);
				}
				public function deleteMeeting($data = array())
				{
				//Enter_Your_Email
				$request_url = "https://api.zoom.us/v2/meetings/".$data;

				$headers = array(
					"authorization: Bearer ".$this->generateJWTKey(),
					"content-type: application/json",
					"Accept: application/json",
				);

				

					$ch = curl_init();
					curl_setopt_array($ch, array(
						CURLOPT_URL => $request_url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "DELETE",
					CURLOPT_HTTPHEADER => $headers,
					));

					$response = curl_exec($ch);
					
				
					curl_close($ch);
				if ($response!="") {
					$response=json_decode($response);
							return $response->message;
				}
				{
					return "meeting cancelled successfully";
				}
					
				}
}