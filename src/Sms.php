<?php

namespace Alishojaeiir\Smschi;


class Sms
{

    /**
     * Mobile
     *
     * @var string
     */
    protected $mobile;

    /**
     * Sms's content
     *
     * @var string
     */
    protected $content;

    /**
     * Sms's sendDate
     *
     * @var DateTime
     */
    protected $sendDate;

    /**
     * @var string
     */
    protected $driver;

    /**
     * Sms constructor.
     */
    public function __construct(){}


    /**
     * Set the mobile of Sms
     *
     * @param $mobile
     *
     * @return $this
     *
     */
    public function mobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get the mobile of Sms
     *
     * @return int
     */
    public function getMobile()
    {
        return $this->mobile;
    }



    /**
     * Set the sendDate of Sms
     *
     * @param $sendDate
     *
     * @return $this
     *
     */
    public function sendDate($sendDate)
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    /**
     * Get the sendDate of Sms
     *
     * @return DateTime
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * set content of Sms
     *
     * @param $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the content of Sms
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of driver
     *
     * @param $driver
     *
     * @return $this
     */
    public function via($driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get the value of driver
     *
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }
}
