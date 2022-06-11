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
    public function mergeOptions(array $attributes)
    {
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

    /**
     * Get the server key
     *
     * @return string
     * @throws InvalidConfiguration
     */
    public function getServerKey()
    {
        if (empty($this->config['server_key'])) {
            throw InvalidConfiguration::missingServerKey();
        }

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
        if (empty($this->config['client_key'])) {
            throw InvalidConfiguration::missingClientKey();
        }

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
        if (empty($this->config['mode'])) {
            throw InvalidConfiguration::missingMode();
        }

        if ($this->allowedMode($this->config['mode']) === false) {
            throw InvalidConfiguration::invalidModeValue();
        }

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