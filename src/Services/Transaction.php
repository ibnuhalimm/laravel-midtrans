<?php

namespace Ibnuhalimm\LaravelMidtrans\Services;

use Ibnuhalimm\LaravelMidtrans\Exceptions\CouldNotSendRequest;
use Ibnuhalimm\LaravelMidtrans\Exceptions\ErrorResponse;
use Midtrans\Transaction as MidtransTransaction;

class Transaction
{
    /** @var string Order ID or Transaction ID */
    protected $id;

    /**
     * Set the ID
     *
     * @param  string  $id
     * @return $this
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Retrives the transaction details
     * for a specified ORDER_ID / TRANSACTION_ID
     *
     * @return mixed
     * @throws \Exceptions
     */
    public function getDetails()
    {
        try {
            return MidtransTransaction::status($this->id);
        } catch (\Exception $e) {
            throw ErrorResponse::throwError($e);
        }
    }

    /**
     * Update the status of the transaction
     *
     * @param  string  $statusName
     * @return mixed
     * @throws CouldNotSendRequest
     */
    public function updateStatus(string $statusName)
    {
        try {
            if ($statusName == 'approve') {
                return MidtransTransaction::approve($this->id);
            }

            if ($statusName == 'cancel') {
                return MidtransTransaction::cancel($this->id);
            }

            throw CouldNotSendRequest::invalidStatusName();
        } catch (\Exception $e) {
            throw ErrorResponse::throwError($e);
        }
    }
}