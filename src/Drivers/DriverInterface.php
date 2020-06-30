<?php

namespace Alishojaeiir\Smschi\Drivers;

interface DriverInterface
{
    /**
     * Set smschi mobile.
     *
     * @param $mobile
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function mobile($mobile);

    /**
     * Send the sms.
     *
     * @return mixed
     */
    public function send();
}
