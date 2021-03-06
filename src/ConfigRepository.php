<?php

namespace Ibnuhalimm\LaravelMidtrans;

use Ibnuhalimm\LaravelMidtrans\Exceptions\InvalidConfiguration;
use Midtrans\Config;

class ConfigRepository
{
    /** @var array */
    protected $config;

    /**
     * Create new instance
     *
     * @param  array  $config
     * @return void
     */
    public function __construct(array $config)
    {
        $this->config = $config;

        $this->setupMidtransConfig();
    }

    /**
     * Set all required config value
     * of midtrans API
     *
     * @return void
     */
    public function setupMidtransConfig()
    {
        Config::$serverKey = $this->getServerKey();
        Config::$clientKey = $this->getClientKey();
        Config::$isProduction = $this->isProductionMode();
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Merge the config with new value of config attributes
     *
     * @param  array  $attributes
     * @return void
     */
    public function mergeOptions(?array $attributes = null)
    {
        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                if ($key == 'server_key') {
                    $this->setServerKey($value);
                } elseif ($key == 'client_key') {
                    $this->setClientKey($value);
                } elseif ($key == 'mode') {
                    $this->setMode($value);
                }
            }
        }

        $this->setupMidtransConfig();
    }

    /**
     * Get the server key
     *
     * @return string
     * @throws InvalidConfiguration
     */
    public function getServerKey()
    {
        return $this->config['server_key'];
    }

    /**
     * Set the server key
     *
     * @param  string  $serverKey
     * @return $this
     */
    public function setServerKey(string $serverKey)
    {
        $this->config['server_key'] = $serverKey;

        return $this;
    }

    /**
     * Get the client key
     *
     * @return string
     * @throws InvalidConfiguration
     */
    public function getClientKey()
    {
        return $this->config['client_key'];
    }

    /**
     * Set the client key
     *
     * @param  string  $clientKey
     * @return $this
     */
    public function setClientKey(string $clientKey)
    {
        $this->config['client_key'] = $clientKey;

        return $this;
    }

    /**
     * Ensure that the current environment is production or not
     *
     * @return bool
     * @throws InvalidConfiguration
     */
    public function isProductionMode()
    {
        return $this->config['mode'] == 'production';
    }

    /**
     * Set the environment mode
     *
     * @param  string  $mode
     * @return $this
     */
    public function setMode(string $mode)
    {
        $this->config['mode'] = $mode;

        return $this;
    }

    /**
     * Check that the mode is allowed
     *
     * @param  string  $modeValue
     * @return bool
     */
    private function allowedMode(string $modeValue)
    {
        return in_array($modeValue, [ 'sandbox', 'production' ]);
    }
}