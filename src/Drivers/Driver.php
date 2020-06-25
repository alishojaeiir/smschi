<?php
namespace Alishojaeiir\Smschi\Drivers;

use Alishojaeiir\Smschi\Drivers\DriverInterface;
use Alishojaeiir\Smschi\Sms;

abstract class Driver implements DriverInterface
{
    /**
     * Sms
     *
     * @var Sms
     */
    protected $sms;

    /**
     * Driver's settings
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
    abstract public function __construct(Sms $sms, $settings);

    /**
     * Send the Sms
     *
     * @return mixed
     */
    abstract public function send();

    /**
     * Set smschi mobile.
     *
     * @param $mobile
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function mobile($mobile)
    {
        $this->invoice->mobile($mobile);
        return $this;
    }
}
