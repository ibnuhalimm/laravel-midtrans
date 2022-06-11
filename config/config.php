<?php

return [
    /**
     * Set your merchant server key
     */
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),

    /**
     * Set your merchant client key
     */
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),

    /**
     * Set the environment mode of your midtrans transaction.
     * The default value is sandbox.
     *
     * Allowed value is `sandbox` OR `production`
     */
    'mode' => env('MIDTRANS_MODE', 'sandbox')
];