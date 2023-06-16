<?php
/**
 *    oeMessage
 *  Fax UI Client Controller Class (REST interface Fax/SMS)
 *    Copyright (c)2018 - Jerry Padgett. Padgett's Consulting
 *
 *    This program is licensed software: licensee is granted a limited nonexclusive
 *  license to install this Software on more than one computer system, as long as all
 *  systems are used to support a single licensee. Licensor is and remains the owner
 *  of all titles, rights, and interests in program.
 *
 *  Licensee will not make copies of this Software or allow copies of this Software
 *  to be made by others, unless authorized by the licensor. Licensee may make copies
 *  of the Software for backup purposes only.
 *
 *    This program is distributed in the hope that it will be useful, but WITHOUT
 *    ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 *  FOR A PARTICULAR PURPOSE. LICENSOR IS NOT LIABLE TO LICENSEE FOR ANY DAMAGES,
 *  INCLUDING COMPENSATORY, SPECIAL, INCIDENTAL, EXEMPLARY, PUNITIVE, OR CONSEQUENTIAL
 *  DAMAGES, CONNECTED WITH OR RESULTING FROM THIS LICENSE AGREEMENT OR LICENSEE'S
 *  USE OF THIS SOFTWARE.
 *
 * @package oeMessage
 * @version 1.0
 * @copyright Jerry Padgett
 * @author Jerry Padgett <sjpadgett@gmail.com>
 * @uses Fax and Patient SMS Notifications
 *
 **/

require_once(__DIR__ . '/../../vendor/autoload.php');
require_once('oeDispatcher.php');

use RingCentral\SDK\Http\ApiException;
use RingCentral\SDK\Http\ApiResponse;
use RingCentral\SDK\Http\MultipartBuilder;
use RingCentral\SDK\SDK;

date_default_timezone_set('EST');

// Make all PHP errors to be thrown as Exceptions

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

// Set up global exception handler (this includes Guzzle HTTP Exceptions)

set_exception_handler(function (Exception $e) {

    $err = 'Exception: ' . $e->getMessage() . PHP_EOL;

    if ($e instanceof ApiException) {

        $err .= 'SDK HTTP Error at ' . $e->apiResponse()->request()->getUri() . PHP_EOL .
            'Response text: ' . $e->apiResponse()->text() . PHP_EOL;
    }

    if ($e->getPrevious()) {
        $err .= 'Previous: ' . $e->getPrevious()->getMessage() . PHP_EOL;
    }

    $err .=  $e->getTraceAsString() . PHP_EOL;
    echo nl2br($err);
    exit();
});

class clientController extends oeDispatchController
{
    public $baseDir;
    public $platform;
    public $rcsdk;
    public $uriDir;
    public $serverUrl;
    public $portalUrl;
    public $credentials;

    public function __construct()
    {
        parent::__construct();
        $this->baseDir = $GLOBALS['OE_SITE_DIR'] . DIRECTORY_SEPARATOR . "Message-Store";
        $this->uriDir = $GLOBALS['OE_SITE_WEBROOT'] . "/Message-Store";
        $this->authenticate(false);
    }

    public function indexAction()
    {
        if (!$this->getSession('pid', '')) {
            $pid = $this->getRequest('patient_id');
            $this->setSession('pid', $pid);
        } else {
            $pid = $this->getSession('pid', '');
        }

        return null;
    }

    public function authenticate($flg = '')
    {
        $baseDir = $GLOBALS['OE_SITE_DIR'] . DIRECTORY_SEPARATOR . "Message-Store";
        $this->baseDir = $baseDir;
        $this->uriDir = $GLOBALS['OE_SITE_WEBROOT'] . "/Message-Store";

        $cacheDir = $baseDir . DIRECTORY_SEPARATOR . '_cache';
        $file = $cacheDir . DIRECTORY_SEPARATOR . 'platform.json';
       
        if (!file_exists($cacheDir . '/_credentials.php')) {
            mkdir($cacheDir, 0777, true);
            $credentials = require(__DIR__ . '/../../_credentials.php');
            file_put_contents($cacheDir . '/_credentials.php', json_encode($credentials));
        }
        $credentials = json_decode(file_get_contents($cacheDir . '/_credentials.php'), true);
        
        $this->portalUrl = !$credentials['production'] ? "https://service.devtest.ringcentral.com/" : "https://service.ringcentral.com/";
       
        $this->credentials = $credentials;
        if ($flg) return;
        
        $this->serverUrl = !$credentials['production'] ? "https://platform.devtest.ringcentral.com" : "https://platform.ringcentral.com";
            
            $this->rcsdk = new SDK($credentials['appKey'], $credentials['appSecret'], $this->serverUrl, 'OpenEMR', '1.0.0');
        
        $this->platform = $this->rcsdk->platform();
        $cachedAuth = array();

        if (file_exists($file)) {
            $cachedAuth = json_decode(file_get_contents($file), true);
            //unlink($file); // dispose cache file, it will be updated if script ends successfully
        }
       
        $this->platform->auth()->setData($cachedAuth);
        $r = 'false';
        try {
            $r = $this->platform->refresh();
            //'restored';
        } catch (Exception $e) {
            $r = $this->platform->login($credentials['username'], $credentials['extension'], $credentials['password']);
        }
        
        // Save authentication data
        file_put_contents($file, json_encode($this->platform->auth()->data(), JSON_PRETTY_PRINT));
        return $r;
    }

    public function sendSMS($tophone = '', $subject = '', $message = '', $from = '')
    {
        if (!$this->rcsdk) {
            $this->authenticate();
        }

        //$phoneNumbers = $this->platform->get('/account/~/extension/~/phone-number', array('perPage' => 'max'))->json()->records;

        $smsNumber = $this->credentials['smsNumber'];
       // $message=$this->credentials['smsMessage'];
        if ($smsNumber) {

            $response = $this->platform
                ->post('/account/~/extension/~/sms', array(
                    'from' => array('phoneNumber' => $smsNumber),
                    'to' => array(
                        array('phoneNumber' => $tophone),
                    ),
                    'text' => $message,
                ));
        } else {
            return false;
        }

        sleep(1); // RC May only allow 1 a second.
        return true;
    }

    public function getCredentials()
    {
        $baseDir = $GLOBALS['OE_SITE_DIR'] . DIRECTORY_SEPARATOR . "Message-Store";
        $cacheDir = $baseDir . DIRECTORY_SEPARATOR . '_cache';
        $c = json_decode(file_get_contents($cacheDir . '/_credentials.php'), true);
        return $c;
    }

    public function saveSetupAction()
    {
        $username = $this->getRequest('username');
        $ext = $this->getRequest('extension');
        $password = $this->getRequest('password');
        $appkey = $this->getRequest('key');
        $appsecret = $this->getRequest('secret');
        $production = $this->getRequest('production');
        $smsNumber = $this->getRequest('smsnumber');
        $smsMessage = $this->getRequest('smsmessage');
        $smsHours = $this->getRequest('smshours');
        $setup = array(
            'username' => "$username", // your RingCentral account phone number
            'extension' => "$ext", // or number
            'password' => "$password",
            'appKey' => "$appkey",
            'appSecret' => "$appsecret",
            'server' => !$production ? 'https://platform.devtest.ringcentral.com' : "https://platform.ringcentral.com",
            'portal' => !$production ? "https://service.devtest.ringcentral.com/" : "https://service.ringcentral.com/",
            'smsNumber' => "$smsNumber",
            'production' => $production,
            'smsHours' => $smsHours,
            'smsMessage' => $smsMessage
        );
        $baseDir = $GLOBALS['OE_SITE_DIR'] . DIRECTORY_SEPARATOR . "Message-Store";
        $this->baseDir = $baseDir;

        $cacheDir = $baseDir . DIRECTORY_SEPARATOR . '_cache';
        $file = $cacheDir . DIRECTORY_SEPARATOR . 'platform.json';
        if (!file_exists($cacheDir . '/_credentials.php')) {
            mkdir($cacheDir, 0777, true);
        }

        file_put_contents($cacheDir . '/_credentials.php', json_encode($setup));
        return 'Save Success';
    }

// this returns encoded uri of document.
    public function getStoredDocAction()
    {
        $pid = $this->getRequest(pid);
        $docid = $this->getRequest(docid);
        $docuri = $this->getRequest(docuri);
        $uri = $docuri;
        //print "Retrieving ${uri}" . PHP_EOL;
        $this->authenticate();
        try {
            $apiResponse = $this->platform->get($uri);
        } catch (ApiException $e) {
            $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();
            $r = "Error Retrieving Fax:\n" . $message;
            return $r;
        }
        if ($apiResponse->response()->getHeader('Content-Type')[0] == 'application/pdf') {
            $ext = 'pdf';
            $type = 'Fax';
            $doc = 'data:application/pdf;base64, ' . rawurlencode(base64_encode((string)$apiResponse->raw()));
        } else if ($apiResponse->response()->getHeader('Content-Type')[0] == 'image/tiff') {
            $ext = 'tif';
            $type = 'Fax';
            $doc = 'data:image/tiff;base64, ' . rawurlencode(base64_encode((string)$apiResponse->raw()));
        } else {
            $ext = 'txt';
            $type = 'text/html';
            $doc = (string)$apiResponse->raw();
        }
        $r = $apiResponse->raw() ? $apiResponse->raw() : "error";
        return $doc ? $doc : $r;
    }

    /**
     * @return string
     */
    public function viewFaxAction()
    {
        $pid = $this->getRequest('pid');
        $docid = $this->getRequest('docid');
        $docuri = $this->getRequest('docuri');
        $isDownload = $this->getRequest('download');
        $uri = $docuri;
        $isDownload = $isDownload == 'true' ? 1 : 0;

        $this->authenticate();

        $messageStoreDir = $this->baseDir;

        if (!file_exists($messageStoreDir)) {
            mkdir($messageStoreDir, 0777, true);
        }

        try {
            $apiResponse = $this->platform->get($uri);
        } catch (ApiException $e) {
            $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();
            $r = "Error Retrieving Fax:\n" . $message;
            return $r;
        }

        if ($apiResponse->response()->getHeader('Content-Type')[0] == 'application/pdf') {
            $ext = 'pdf';
            $type = 'Fax';
            $doc = 'data:application/pdf;base64, ' . rawurlencode(base64_encode((string)$apiResponse->raw()));
        } else if ($apiResponse->response()->getHeader('Content-Type')[0] == 'image/tiff') {
            $ext = 'tiff';
            $type = 'Fax';
            $doc = 'data:image/tiff;base64, ' . rawurlencode(base64_encode((string)$apiResponse->raw()));
        } else if ($apiResponse->response()->getHeader('Content-Type')[0] == 'audio/wav' || $apiResponse->response()->getHeader('Content-Type')[0] == 'audio/x-wav') {
            $ext = 'wav';
            $type = 'Audio';
            //$doc = 'data:image/tiff;base64, ' . rawurlencode(base64_encode((string)$apiResponse->raw()));
        } else {
            $ext = 'txt';
            $type = 'Text';
            $doc = (string)$apiResponse->raw();
        }

        $fname = "${messageStoreDir}/${type}_${docid}.${ext}";
        file_put_contents($fname, $apiResponse->raw());
        if ($isDownload) {
            return $fname;
        }
        $furi = "$this->uriDir/${type}_${docid}.${ext}";
        return $furi;
    }

    public function disposeDocAction()
    {
        
        $pid = $this->getRequest('pid');
        $where = $this->getRequest('where');
        $docid = $this->getRequest('docid');
        $repid = $this->getRequest('repid');
        if (file_exists($where)) {            
            ob_clean();
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=" . basename($where));
            header("Content-Type: application/download");
            header("Content-Transfer-Encoding: binary");
            header('Content-Length: ' . filesize($where));

            readfile($where);
            //unlink($where);
            exit;
        }
        die('Problem with download. Use browser back button');
    }

    public function sendFaxAction()
    {
       
        $pid = $this->getRequest('pid');
        $isContent = $this->getRequest('isContent');
        $file = $this->getRequest('file');
        $phone = $this->getRequest('phone');
        $name = $this->getRequest('name');
        $lastname = $this->getRequest('surname');
        $isDocuments = $this->getRequest('isDocuments');
        $comments = $this->getRequest('comments');
        $name = $name . ' ' . $lastname;

        /*if ($isDocuments) { // future for documents controller redirect
            $patid = $_REQUEST['patient_id'];
            $docid = isset($_REQUEST['document_id']) ? $_REQUEST['document_id'] : $_REQUEST['doc_id'];
            $d = new Document(attr($docid));
            $type = $d->get_mimetype();
            $file = $d->url;
            //$content = (string) file_get_contents($faxfile);
            if ($d->get_mimetype() == 'application/dicom+zip') {
                $type = '.zip';
            }
        }*/
               
        $r = $this->sendFax($file, $phone, $name, $comments, $isContent, $isDocuments);
        return $r;
    }

    public function sendFax($file, $phone = '', $name = '', $comments = '', $isContent = '', $isDocuments)
    {
        if (!$this->rcsdk) {
            $this->authenticate();
        }
        if ($isContent) {
            $content = $file;
            $file = 'report-' . $GLOBALS['pid'] . '.pdf';
        } else {
            $content = file_get_contents($file);
            if (!$isDocuments) {
                unlink($file);
            }
        }
        $type = \GuzzleHttp\Psr7\mimetype_from_filename(basename($file));
        $request = $this->rcsdk->createMultipartBuilder()
            ->setBody(array(
                'to' => array(
                    array(
                        'phoneNumber' => $phone,
                        'name' => $name)
                ),
                'faxResolution' => 'High',
                'coverPageText' => $comments
            ))
            ->add($content, $file, array('Content-Type' => "$type"))
            ->request('/account/~/extension/~/fax');

        //$debug = $request->getBody() . PHP_EOL;

        $response = $this->platform->sendRequest($request);

        return 'Fax Successfully Sent';
    }

    public function getUserAction()
    {
        $id = $this->getRequest('uid');
        $query = "SELECT * FROM users WHERE id = ?";
        $result = sqlStatement($query, array($id));
        $u = array();
        foreach ($result as $row) {
            $u[] = $row;
        }
        $u = $u[0];
        $r = array($u['fname'], $u['lname'], $u['fax']);
        return json_encode($r);
    }

    public function getNotificationLogAction()
    {
        $type = $this->getRequest('type');
        $fromDate = $this->getRequest('datefrom');
        $toDate = $this->getRequest('dateto');

        try {
            $query = "SELECT notification_log.* FROM notification_log WHERE notification_log.dSentDateTime > ? AND notification_log.dSentDateTime < ?";
            $res = sqlStatement($query, array($fromDate, $toDate));
            $row = array();
            $cnt = 0;
            while ($nrow = sqlFetchArray($res)) {
                $row[] = $nrow;
                $cnt++;
            }

            $responseMsgs = 'No Logs Available';

            foreach ($row as $value) {
                $adate = ($value['pc_eventDate'] . '::' . $value['pc_startTime']);
                $pinfo = str_replace("|||", " ", $value['patient_info']);
                $msg = htmlspecialchars($value["message"], ENT_QUOTES);

                $responseMsgs .= "<tr><td>" . $value["pc_eid"] . "</td><td>" . $value["dSentDateTime"] . "</td><td>" . $adate . "</td><td>" . $pinfo . "</td><td>" . $msg . "</td></tr>";
            }

        } catch (ApiException $e) {
            $message = $e->getMessage();
            return 'Error: ' . $message . PHP_EOL;

        }
        return $responseMsgs;
    }

    public function getCallLogsAction()
    {
        $type = $this->getRequest('type');
        $fromDate = $this->getRequest('datefrom');
        $toDate = $this->getRequest('dateto');

        $auth = $this->authenticate();
        try {
            // constants
            $pageCount = 1;
            $recordCountPerPage = 100;
            $timePerCallLogRequest = 10;
            $flag = True;

            // Export call-log response to json file
            $dir = $fromDate;
            $callLogDir = $GLOBALS['OE_SITE_DIR'] . DIRECTORY_SEPARATOR . "Message-Store" . '/Call-Logs/' . $dir;

            //Create the Directory if saving .. comment in to log
            /*if (!file_exists($callLogDir)) {
                mkdir($callLogDir, 0777, true);
            }*/

            // dateFrom and dateTo paramteres
            $timeFrom = '00:00:00.000Z';
            $timeTo = '23:59:59.000Z';
            // Array to push the call-logs to a file
            $callLogs = array();
            $responseMsgs = "";

            while ($flag) {
                // Start Time
                $start = microtime(true);
                $dateFrom = $fromDate . 'T' . $timeFrom;
                $dateTo = $toDate . 'T' . $timeTo;

                $apiResponse = $this->platform->get('/account/~/extension/~/call-log', array(
                    'dateFrom' => $dateFrom,
                    'dateTo' => $dateTo,
                    //'type' => 'SMS',
                    'perPage' => 500,
                    'page' => $pageCount
                ));

                $apiResponseArray = $apiResponse->json()->records;
                $responseMsgs = 'No Logs Available';
                $from_name=isset($value->from->name)?$value->from->name:'';
                $toname=isset($value->to->name)?$value->to->name:'';
                $message_id=isset($value->message->id)?$value->message->id:'';
                foreach ($apiResponseArray as $value) {
                    $responseMsgs .= "<tr><td>" . str_replace(array("T", "Z"), " ", $value->startTime) . "</td><td>" . $value->type . "</td><td>" . $from_name . "</td><td>" . $toname . "</td><td>" . $value->action . "</td><td>" . $value->result . "</td><td>" . $message_id . "</td></tr>";
                    array_push($callLogs, $value);
                }

                $end = microtime(true);

                //print 'Page ' . $pageCount . 'retreived with ' . $recordCountPerPage . 'records' . PHP_EOL;

                // Check if the recording completed wihtin 10 seconds.
                $time = ($end * 1000 - $start * 1000) / 1000;

                // Check if 'nextPage' exists
                if (isset($apiResponseJSONArray["navigation"]["nextPage"])) {
                    if ($time < $timePerCallLogRequest) {
                        sleep($timePerCallLogRequest - $time);
                        sleep(5);
                        $pageCount = $pageCount + 1;
                    }
                } else {
                    //file_put_contents("${callLogDir}/call_log_${'dir'}.json", json_encode($callLogs));
                    $flag = False;
                    unset($callLogs);

                }
            }
        } catch (ApiException $e) {
            $message = $e->getMessage();
            return 'HTTP Error: ' . $message . PHP_EOL;

        }
        return $responseMsgs;
    }

    public function getPendingAction()
    {
        $pid = $this->getRequest('pid');
        $dateFrom = $this->getRequest('datefrom');
        $dateTo = $this->getRequest('dateto');
        $type = $this->getRequest('type');

        $phoneBookList=$this->phoneBook();
        try {
            $this->authenticate();
            // Writing the call-log response to json file
            $dir = 'fax';
            $messageStoreDir = $this->baseDir; // . DIRECTORY_SEPARATOR . $dir;

            //Create the Directory
            if (!file_exists($messageStoreDir)) {
                mkdir($messageStoreDir, 0777, true);
            }
            // dateFrom and dateTo paramteres
            $timeFrom = 'T00:00:01.000Z';
            $timeTo = 'T23:59:59.000Z';
            $dateFrom = trim($dateFrom) . $timeFrom;
            $dateTo = trim($dateTo) . $timeTo;

            $messageStoreList = $this->platform->get('/account/~/extension/~/message-store', array(
                //'messageType' => "",
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo
            ))->json()->records;

            //file_put_contents("${messageStoreDir}/message_log.json", json_encode($messageStoreList));
            $timePerMessageStore = 6;
            $responseMsgs = [];
            $sent_msg='';
            $recived_msg='';
            $sms_log='';
            foreach ($messageStoreList as $i => $messageStore) {
                
                if (property_exists($messageStore, 'attachments')) {
                    foreach ($messageStore->attachments as $i => $attachment) {
                        $lastmofieddate=isset($messageStore->lastModifiedTime)?$messageStore->lastModifiedTime:'';
                        $modifed_type=isset($messageStore->type)?$messageStore->type:'';
                        $faxpage=isset($messageStore->faxPageCount)?$messageStore->faxPageCount:'';
                        $id = $attachment->id;
                        $uri = $attachment->uri;
                        if(isset($messageStore->to[0]))
                        {
                            $toname=isset($messageStore->to[0]->name)?$messageStore->to[0]->name:'';
                            $to_phone=isset($messageStore->to[0]->phoneNumber)?$messageStore->to[0]->phoneNumber:'';
                            $to = $toname . " " . $to_phone;
                        }
                        else{
                         $to='';  
                        }
                        if(isset($messageStore->from))
                        {
                            $from_name=isset($messageStore->from->name)?$messageStore->from->name:'';
                            $from_phoneno=isset($messageStore->from->phoneNumber)?$messageStore->from->phoneNumber:'';
                            $from = $from_name . " " . $from_phoneno;
                        }
                        else{
                            $from= '';
                           // $from= 'Saravanan Kuppuswamy';

                        }
                        
                        
                        if(isset($messageStore->to[0])){
                            $fax_error_code=isset($messageStore->to[0]->faxErrorCode)? $messageStore->to[0]->faxErrorCode :'';
                            $error_code=isset($messageStore->from->faxErrorCode)? $messageStore->from->faxErrorCode :'';
                            $errors = $fax_error_code ? "why: " . $fax_error_code : $error_code;
                        }
                        else{
                            $errors = '';
                        }
                       

                       
                        $status = $messageStore->messageStatus . " " . $errors;
                        $aUrl = "<a href='#' onclick=getDocument(" . "event,'$uri','$id','true')>" . $id . " <i class='fa fa-download' aria-hidden='true'></i></a></br>";
                        $vUrl = "<a href='#' onclick=getDocument(" . "event,'$uri','$id','false')> <i class='fa fa-eye' aria-hidden='true'></i></a></br>";

                        if (strtolower($messageStore->type) === "sms") {
                            $sms_log.="<tr><td>" . str_replace(array("T", "Z"), " ", $lastmofieddate) . "</td><td>" . $modifed_type . "</td><td>" . $this->contactMatch($from, $phoneBookList) . "</td><td>" . $this->contactMatch($to, $phoneBookList) . "</td><td>" . $status . "</td><td>" . $aUrl . "</td><td>" . $vUrl . "</td></tr>";                          
                        }
                        if(isset($messageStore->messageStatus)&&$messageStore->messageStatus=='Received'){
                            $recived_msg.="<tr><td>" . str_replace(array("T", "Z"), " ", $lastmofieddate) . "</td><td>" . $modifed_type . "</td><td>" . $faxpage . "</td><td>" . $from . "</td><td>" . $to . "</td><td>" . $status . "</td><td>" . $aUrl . "</td><td>" . $vUrl . "</td></tr>";
                            
                        }
                        if(isset($messageStore->messageStatus)&&$messageStore->messageStatus=='Sent'||isset($messageStore->messageStatus)&&$messageStore->messageStatus=='SendingFailed')
                        {
                            $sent_msg.="<tr><td>" . str_replace(array("T", "Z"), " ", $lastmofieddate) . "</td><td>" . $modifed_type . "</td><td>" . $faxpage . "</td><td>" . $from . "</td><td>" . $to . "</td><td>" . $status . "</td><td>" . $aUrl . "</td><td>" . $vUrl . "</td></tr>";
                            
                        }
                    }
                } else {
                    print "does not have message" . PHP_EOL;
                    exit();
                }
            }
            $sent_msg=$sent_msg!=''?$sent_msg:'No Logs Available';
            $recived_msg=$recived_msg!=''?$recived_msg:'No Logs Available';
            $sms_log=$sms_log!=''?$sms_log:'No Logs Available';
            $responseMsgs['sent']=$sent_msg;
            $responseMsgs['received']=$recived_msg;
            $responseMsgs['sms_log']=$sms_log;
            
            
        } catch (ApiException $e) {
            $message = $e->getMessage(); // . $e->apiResponse()->request()->getUri()->__toString();
            $responseMsgs[] = $responseMsgs[] = $responseMsgs[] = "<tr><td>Error: " . $message . " Ensure credentials are correct.</td></tr>";
            print json_encode($responseMsgs);
            exit();
        }
        echo json_encode($responseMsgs);
        exit();
    }

    private function phoneCheck($phoneNumber){
        if($phoneNumber=='')
            return false;

        $phoneNumber=preg_replace('/[^0-9]/', '', $phoneNumber);

        if(strlen($phoneNumber)==10)
            return $phoneNumber;
        else
            return false;
    }
    private function phoneBook(){
        $resultArray=[];
        $result="SELECT GROUP_CONCAT(DISTINCT field_id ORDER BY field_id DESC SEPARATOR ',') AS fields FROM layout_options WHERE form_id='DEM' AND field_id LIKE '%phone%'";

        $query1 = sqlQuery($result);
    
        $field=($query1['fields']);
        
        $query2=sqlStatement("SELECT $field, CONCAT(fname,'',lname,'',mname) AS patient_name FROM patient_data");
    
        while ($query3 = sqlFetchArray($query2)){
            foreach($query3 as $key=>$result){
                if($key!="patient_name"){
                    $phoneNumber=$this->phoneCheck($result);
                    if($phoneNumber){
                        $resultArray[$phoneNumber]="[P] ".$query3['patient_name'];
                    }
                }
            }
        }
    
        $result1=sqlStatement("SELECT phone, phonew1, phonew2, phonecell, CONCAT(fname,' ',lname,' ',mname) AS user_name FROM users");
        while ($query4 = sqlFetchArray($result1)){
            foreach($query4 as $key=>$result){
                if($key!="user_name"){
                    $phoneNumber=$this->phoneCheck($result);
                    if($phoneNumber)
                        $resultArray[$phoneNumber]="[U] ".$query4['user_name'];
                }
            }
        }
        return $resultArray;
    }
    private function contactMatch($phoneNumber, $phoneBookList){
        $lastTenDigit=substr($phoneNumber, -10);
        if(isset($phoneBookList[$lastTenDigit])){
            return $phoneBookList[$lastTenDigit]." ".$phoneNumber;
        }

        return $phoneNumber;
    }
    public function getMessageAction()
    {
        $pid = $this->getRequest(pid);
        $dateFrom = $this->getRequest(datefrom);
        $dateTo = $this->getRequest(dateto);
        $type = $this->getRequest(type);

        try {
            $this->authenticate();
            // Writing the call-log response to json file
            $dir = 'fax';
            $messageStoreDir = $this->baseDir; // . DIRECTORY_SEPARATOR . $dir;

            //Create the Directory
            if (!file_exists($messageStoreDir)) {
                mkdir($messageStoreDir, 0777, true);
            }

            $messageStoreList = $this->platform->get('/account/~/extension/~/message-store', array(
                'messageType' => "",
                'dateFrom' => '2018-05-01'
            ))->json()->records;

            //file_put_contents("${messageStoreDir}/message_log.json", json_encode($messageStoreList));

            $timePerMessageStore = 6;
            $responseMsgs = "";
            foreach ($messageStoreList as $i => $messageStore) {
                if (property_exists($messageStore, 'attachments')) {
                    foreach ($messageStore->attachments as $i => $attachment) {
                        $id = $attachment->id;
                        $uri = $attachment->uri;
                        //print "Retrieving ${uri}" . PHP_EOL;
                        try {
                            $apiResponse = $this->platform->get($uri);
                        } catch (ApiException $e) {
                            $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();
                            $responseMsgs .= "<tr><td>Error: " . $message . "</td></tr>";
                            continue;
                        }
                        // Retreive the appropriate extension type of the message
                        if ($apiResponse->response()->getHeader('Content-Type')[0] == 'application/pdf') {
                            $ext = 'pdf';
                            $type = 'Fax';
                        } else if ($apiResponse->response()->getHeader('Content-Type')[0] == 'audio/mpeg') {
                            $ext = 'mp3';
                            $type = 'VoiceMail';
                        } else {
                            $ext = 'txt';
                            $type = 'SMS';
                        }

                        $start = microtime(true);
                        file_put_contents("${messageStoreDir}/${type}_${id}.${ext}", $apiResponse->raw());
                        //print "Wrote File for Call Log Record ${id}" . PHP_EOL;
                        $responseMsgs .= "<tr><td>" . $messageStore->creationTime . "</td><td>" . $messageStore->type . "</td><td>" . $messageStore->from->name . "</td><td>" . $messageStore->to->name . "</td><td>" . $messageStore->availability . "</td><td>" . $messageStore->messageStatus . "</td><td>" . $messageStore->message->id . "</td></tr>";
                        $end = microtime(true);
                        $time = ($end * 1000 - $start * 1000);
                        if ($time < $timePerMessageStore) {
                            sleep($timePerMessageStore - $time);
                        }
                    }
                } else {
                    print "does not have message" . PHP_EOL;
                }
            }
        } catch (ApiException $e) {
            $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();
            print $responseMsgs .= "<tr><td>Error: " . $message . "</td></tr>";
            exit();
        }
        echo $responseMsgs;
        exit();
    }

    // public function video()
    // {
    //     if (!$this->rcsdk) {
    //         $this->authenticate();
    //     }

       

    //         $response = $this->platform
    //             ->post('/account/~/extension/~/meeting', array(
    //                 'topic' => 'Test Meeting',
    //                 'meetingType' => 'Instant',
    //                 'allowJoinBeforeHost' => true,
    //                 'startHostVideo' => false,
    //                 'assignable'=>true,
    //                 'startParticipantsVideo' => false
    //                 ));
            
    //         //echo '<pre>';print_r($this->platform);
    //         // $response = $this->platform
    //         // ->get('https://platform.ringcentral.com/rcvideo/v2/account/~/extension/~/bridges/default');
    //         // $response = $this->platform
    //         // ->get('/account/~/extension/~/authz-profile/check?permissionId=218576701');
               
        
    //     echo '<pre>';print_r($response);exit();            
    //     sleep(1); // RC May only allow 1 a second.
    //     return true;
    // }

    

}
