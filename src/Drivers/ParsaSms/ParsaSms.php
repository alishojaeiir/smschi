<?php

namespace Alishojaeiir\Smschi\Drivers\ParsaSms;

use Alishojaeiir\Smschi\Drivers\Driver;
use AliShojaeiir\Smschi\Exceptions\InvalidSendSmsException;
use Alishojaeiir\Smschi\Sms;
use GuzzleHttp\Client;

class ParsaSms extends Driver
{
    /**
     * send sms.
     *
     * @throws InvalidSendSmsException
     *
     * @return string Indicates the sent sms result
     */
    public function send()
    {
        $apiUrl = $this->settings->apiUrl;
        $apiKey = $this->settings->apiKey;
        $sender = $this->settings->sender;

        try {
            $client = new Client(['http_errors' => false]);
            $result = $client->post($apiUrl.'send/simple', [
                'headers'     => ['apikey' => $apiKey],
                'form_params' => ['message' => $this->sms->getContent(), 'sender' => $sender, 'receptor' => $this->sms->getMobile()],
            ]);

            return json_decode($result->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new InvalidSendSmsException('Sms does not send');
        }
    }
}
