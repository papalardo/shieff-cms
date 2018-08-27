<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '592535811079296', 
        'client_secret' => '8996b53e61fa7ee11418c403ddfe6d80',
        'redirect' => env('APP_URL') . '/api/auth/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '940453168432-9ns1r3lg3s31v0osfij2rsgibc6g1h36.apps.googleusercontent.com', 
        'client_secret' => 'Wc31TfoJbSsDCBMk99DAQf8A',
        'redirect' => env('APP_URL') . '/api/auth/login/google/callback',
    ],

    'instagram' => [
        'client_id' => '0d7bfea95eab47fab70477bd10771e17', 
        'client_secret' => 'e9adad28ffee40279fc8d9b6d3a56789',
        'redirect' => env('APP_URL') . '/api/auth/login/instagram/callback',
    ],

];
