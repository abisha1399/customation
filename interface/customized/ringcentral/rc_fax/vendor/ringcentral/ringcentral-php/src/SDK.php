<?php

namespace RingCentral\SDK;

use GuzzleHttp\Client as GuzzleClient;
use RingCentral\SDK\Http\Client as HttpClient;
use RingCentral\SDK\Http\Client;
use RingCentral\SDK\Http\MultipartBuilder;
use RingCentral\SDK\Platform\Platform;
use RingCentral\SDK\Subscription\Subscription;

class SDK
{

    const VERSION = '2.1.2';
    const SERVER_PRODUCTION = 'https://platform.ringcentral.com';
    const SERVER_SANDBOX = 'https://platform.devtest.ringcentral.com';

    /** @var Client */
    protected $_client;

    /** @var Platform */
    protected $_platform;

    /** @var HttpClient */
    protected $_guzzle;

    public function __construct(
        $clientId,
        $clientSecret,
        $server,
        $appName = '',
        $appVersion = '',
        $guzzle = null
    ) {

        $pattern = "/[^a-z0-9-_.]/i";

        $appName = preg_replace($pattern, '', $appName);
        $appVersion = preg_replace($pattern, '', $appVersion);

        $this->_guzzle = $guzzle ? $guzzle : new GuzzleClient([
            'expect' => false,
            'verify' => false,
            'http_errors' => true
            //'proxy' => "97.106.223.93:5000"
    ]);

        $this->_client = new Client($this->_guzzle);
       // $this->_client->setDefaultOption('headers', array('Expect' => '100-continue'));
        $this->_platform = new Platform($this->_client, $clientId, $clientSecret, $server, $appName, $appVersion);

    }

    public function platform()
    {
        return $this->_platform;
    }

    public function createSubscription()
    {
        return new Subscription($this->_platform);
    }

    public function createMultipartBuilder()
    {
        return new MultipartBuilder();
    }

}