<?php

namespace Alishojaeiir\Smschi\Drivers;

use Alishojaeiir\Smschi\Sms;

abstract class Driver implements DriverInterface
{
    /**
     * Sms.
     *
     * @var Sms
     */
    protected $sms;

    /**
     * Driver's settings.
     *
     * @var
     */
    protected $settings;

    /**
     * Driver constructor.
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
     * Send the Sms.
     *
     * @return mixed
     */
    abstract public function send();

    /**
     * Set smschi mobile.
     *
     * @param $mobile
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function mobile($mobile)
    {
        $this->invoice->mobile($mobile);

        return $this;
    }
}
