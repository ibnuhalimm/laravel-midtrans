<?php

namespace Ibnuhalimm\LaravelMidtrans;

use Ibnuhalimm\LaravelMidtrans\Exceptions\ErrorResponse;
use Ibnuhalimm\LaravelMidtrans\Services\Transaction;
use Midtrans\CoreApi;
use Midtrans\Snap;

class Service
{
    /** @var ConfigRepository */
    protected $configRepo;

    /**
     * Create new instance
     *
     * @return void
     */
    public function __construct(ConfigRepository $configRepo)
    {
        $this->configRepo = $configRepo;

        $this->extractor = new Extractor();
    }

    /**
     * Override the default config.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function setConfig(array $attributes = null)
    {
        $this->configRepo->mergeOptions($attributes);

        return $this;
    }

    /**
     * Get snap token
     *
     * @param  array  $params
     * @return string
     * @throws \Exception
     */
    public function getSnapToken(array $params)
    {
        try {
            return Snap::getSnapToken($params);
        } catch (\Exception $e) {
            throw ErrorResponse::throwError($e);
        }
    }

    /**
     * Get snap token
     *
     * @param  array  $params
     * @return string
     * @throws \Exception
     */
    public function getSnapUrl(array $params)
    {
        try {
            return Snap::getSnapUrl($params);
        } catch (\Exception $e) {
            throw ErrorResponse::throwError($e);
        }
    }

    /**
     * Create transaction to get payment data.
     *
     * @param  array  $params
     * @return mixed
     * @throws \Exception
     */
    public function charge(array $params)
    {
        try {
            return CoreApi::charge($params);
        } catch (\Exception $e) {
            throw ErrorResponse::throwError($e);
        }
    }

    /**
     * Set the order id or transaction id
     *
     * @param  string  $id  Order ID or Transaction ID
     * @return mixed
     * @see \Ibnuhalimm\LaravelMidtrans\Services\Transaction
     */
    public function transaction(string $id)
    {
        return (new Transaction())->setId($id);
    }
}
