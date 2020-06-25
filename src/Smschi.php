<?php

namespace Alishojaeiir\Smschi;

use Alishojaeiir\Smschi\Drivers\DriverInterface;
use Alishojaeiir\Smschi\Exceptions\DriverNotFoundException;
use Alishojaeiir\Smschi\Exceptions\SmsNotFoundException;

class Smschi
{
    /**
     * Sms Configuration.
     *
     * @var array
     */
    protected $config;

    /**
     * Sms Driver Settings.
     *
     * @var array
     */
    protected $settings;

    /**
     * Sms Driver Name.
     *
     * @var string
     */
    protected $driver;

    /**
     * Sms Driver Instance.
     *
     * @var object
     */
    protected $driverInstance;

    /**
     * @var Sms
     */
    protected $sms;

    /**
     * Smschi constructor.
     *
     * @param $config
     *
     * @throws \Exception
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->sms(new Sms());
        $this->via($this->config['default']);
    }

    /**
     * Set custom configs
     * we can use this method when we want to use dynamic configs.
     *
     * @param $key
     * @param $value|null
     *
     * @return $this
     */
    public function config($key, $value = null)
    {
        $configs = [];

        $key = is_array($key) ? $key : [$key => $value];

        foreach ($key as $k => $v) {
            $configs[$k] = $v;
        }

        $this->settings = array_merge($this->settings, $configs);

        return $this;
    }

    /**
     * Set sms mobile number.
     *
     * @param $mobile
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function mobile($mobile)
    {
        $this->sms->mobile($mobile);

        return $this;
    }

    /**
     * Set content of sms.
     *
     * @param $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->sms->content($content);

        return $this;
    }

    /**
     * Change the driver on the fly.
     *
     * @param $driver
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function via($driver)
    {
        $this->driver = $driver;
        $this->validateDriver();
        $this->sms->via($driver);
        $this->settings = $this->config['drivers'][$driver];

        return $this;
    }

    /**
     * @param Sms $sms
     *
     * @return self
     */
    protected function sms(Sms $sms)
    {
        $this->sms = $sms;

        return $this;
    }

    /**
     * Retrieve current driver instance or generate new one.
     *
     * @throws \Exception
     *
     * @return mixed
     */
    protected function getDriverInstance()
    {
        if (!empty($this->driverInstance)) {
            return $this->driverInstance;
        }

        return $this->getFreshDriverInstance();
    }

    /**
     * Get new driver instance.
     *
     * @throws \Exception
     *
     * @return mixed
     */
    protected function getFreshDriverInstance()
    {
        $this->validateDriver();
        $class = $this->config['map'][$this->driver];

        if (!empty($this->callbackUrl)) { // use custom callbackUrl if exists
            $this->settings['callbackUrl'] = $this->callbackUrl;
        }

        return new $class($this->sms, $this->settings);
    }

    /**
     * Validate Sms.
     *
     * @throws SmsNotFoundException
     */
    protected function validateSms()
    {
        if (empty($this->sms)) {
            throw new SmsNotFoundException('Sms does not exist.');
        }
    }

    /**
     * Validate driver.
     *
     * @throws \Exception
     */
    protected function validateDriver()
    {
        if (empty($this->driver)) {
            throw new DriverNotFoundException('Driver not selected or default driver does not exist.');
        }

        if (empty($this->config['drivers'][$this->driver]) || empty($this->config['map'][$this->driver])) {
            throw new DriverNotFoundException('Driver not found in config file. Try updating the package.');
        }

        if (!class_exists($this->config['map'][$this->driver])) {
            throw new DriverNotFoundException('Driver source not found. Please update the package.');
        }

        $reflect = new \ReflectionClass($this->config['map'][$this->driver]);

        if (!$reflect->implementsInterface(DriverInterface::class)) {
            throw new \Exception("Driver must be an instance of Drivers\DriverInterface.");
        }
    }

    /**
     * Purchase the sms.
     *
     * @param Sms $sms|null
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function prepare($mobile, $message)
    {
        if ($mobile and $message) {
            $this->sms->mobile($mobile);
            $this->sms->content($message);
        }
        $this->driverInstance = $this->getFreshDriverInstance();

        return $this;
    }

    /**
     * send the sms.
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function send()
    {
        $this->driverInstance = $this->getDriverInstance();

        $this->validateSms();

        return $this->driverInstance->send();
    }
}
