<?php

namespace Alishojaeiir\Smschi\Drivers\Kavenegar;

use Alishojaeiir\Smschi\Drivers\Driver;
use AliShojaeiir\Smschi\Exceptions\InvalidSendSmsException;
use Alishojaeiir\Smschi\Sms;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Kavenegar extends Driver
{
    /**
     * send sms.
     *
     * @throws InvalidSendSmsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return string Indicates the sent sms result
     */
    public function send()
    {
        $url = $this->settings->apiUrl.$this->settings->apiKey.'/sms/send.json';

        try {
            $client = new Client(['http_errors' => false]);
            $result = $client->post($url, [
                'form_params' => ['text' => $this->sms->getContent(), 'to' => $this->sms->getMobile()],
            ]);

            return json_decode($result->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new InvalidSendSmsException('Sms does not send');
        }
    }

    /**
     * @param this is used to shared Service SMS
     * (استفاده از خط خدماتی اشتراکی)
     *
     * @throws \AliShojaeiir\Smschi\Exceptions\InvalidSendSmsException
     *
     * @return array
     */
    public function sendSharedService($bodyId)
    {
        $url = $this->settings->apiUrl.$this->settings->apiKey.'/verify/lookup.json';

        try {
            $client = new Client(['http_errors' => false]);
            $result = $client->post($url, [
                'form_params' => [
                    'token' => $this->sms->getContent(),
                    'receptor' => $this->sms->getMobile(),
                    'template' => $bodyId[0]
                ],
            ]);
            $result = json_decode($result->getBody()->getContents(), true);
            if (isset($result['result']['status']) && $result['result']['status'] == 200) {
                return $result;
            }
            throw new InvalidSendSmsException($result['result']['message']);
        } catch (\Exception $e) {
            throw new InvalidSendSmsException('Sms does not send');
        }
    }
}
