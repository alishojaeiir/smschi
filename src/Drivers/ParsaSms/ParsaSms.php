<?php
namespace Alishojaeiir\Smschi\Drivers\ParsaSms;

use Alishojaeiir\Smschi\Drivers\Driver;
use AliShojaeiir\Smschi\Exceptions\InvalidSendSmsException;
use Alishojaeiir\Smschi\Sms;
use GuzzleHttp\Client;

class ParsaSms extends Driver
{
    /**
     * Sms
     *
     * @var Sms
     */
    protected $sms;

    /**
     * Driver settings
     *
     * @var object
     */
    protected $settings;

    /**
     * ParsaSms constructor.
     * Construct the class with the relevant settings.
     *
     * @param Sms $sms
     * @param $settings
     */
    public function __construct(Sms $sms, $settings)
    {
        $this->sms = $sms;
        $this->settings = (object) $settings;
    }


    /**
     * send sms.
     *
     * @return string Indicates the sent sms result
     * @throws InvalidSendSmsException
     */
    public function send() {
        $apiUrl = $this->settings->apiUrl;
        $apiKey = $this->settings->apiKey;
        $sender = $this->settings->sender;

        try {
            $client = new Client(['http_errors' => false]);
            $result = $client->post($apiUrl . "send/simple", [
                'headers' => array('apikey' => $apiKey),
                'form_params' => array('message' => $this->sms->getContent(), 'sender' => $sender, 'receptor' => $this->sms->getMobile()),
            ]);
            
            return json_decode($result->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new InvalidSendSmsException('Sms does not send');
        }
    }
}
