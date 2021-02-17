<?php

namespace Alishojaeiir\Smschi\Drivers\Kavenegar;

use Alishojaeiir\Smschi\Drivers\Driver;
use AliShojaeiir\Smschi\Exceptions\InvalidSendSmsException;
use Alishojaeiir\Smschi\Sms;
use GuzzleHttp\Client;

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
     * used to shared Service SMS
     * (استفاده از خط خدماتی اشتراکی)
     *
     * @param $bodyId
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendSharedService($bodyId)
    {
        $url = $this->settings->apiUrl.$this->settings->apiKey.'/verify/lookup.json';

        try {
            $client = new Client(['http_errors' => false]);
            $result = $client->post($url, [
                'form_params' => [
                    'token'    => $this->sms->getContent(),
                    'receptor' => $this->sms->getMobile(),
                    'template' => $bodyId[0],
                ],
            ]);
            $result = json_decode($result->getBody()->getContents(), true);
            if (isset($result['return']['status']) && $result['return']['status'] == 200) {
                return $result;
            }
            throw new \Exception($result['return']['message']);
        } catch (\Exception $e) {
            throw new \Exception('Sms does not send');
        }
    }
}
