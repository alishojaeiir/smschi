<?php

namespace Alishojaeiir\Smschi\Drivers;

interface DriverInterface
{

    /**
     * Set smschi mobile.
     *
     * @param $mobile
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function mobile($mobile);

    
    /**
     * Send the sms
     *
     * @return mixed
     */
    public function send();
}