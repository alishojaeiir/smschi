<?php

namespace Alishojaeiir\Smschi\Drivers\MeliPayamak;

use Alishojaeiir\Smschi\Drivers\Driver;
use AliShojaeiir\Smschi\Exceptions\InvalidSendSmsException;
use Alishojaeiir\Smschi\Sms;
use GuzzleHttp\Client;

class MeliPayamak extends Driver
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
        $url = $this->settings->apiUrl.'/SendSMS';
        $username = $this->settings->username;
        $password = $this->settings->password;
        $sender = $this->settings->sender;

        try {
            $client = new Client(['http_errors' => false]);
            $result = $client->post($url, [
                'form_params' => ['username'=>$username, 'password'=>$password, 'text' => $this->sms->getContent(), 'from' => $sender, 'to' => $this->sms->getMobile()],
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
        $url = $this->settings->apiUrl.'/BaseServiceNumber';
        $username = $this->settings->username;
        $password = $this->settings->password;

        try {
            $client = new Client(['http_errors' => false]);
            $result = $client->post($url, [
                'form_params' => ['username'=>$username,'password'=>$password,'text' => $this->sms->getContent(), 'to' => $this->sms->getMobile(),'bodyId'=>$bodyId[0]],
            ]);

            return json_decode($result->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new InvalidSendSmsException('Sms does not send');
        }
    }
}
