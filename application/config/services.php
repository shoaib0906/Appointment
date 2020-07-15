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

    'twitter' => [
      'client_id' => '0670c5qXsxs0hwWNxsmAEzbkZ',
      'client_secret' => 'URgJbq3cFITrCLTJJP1tkouyWB5QhOcSRdQiDpt9QUyJy4W8i2',
      'redirect' => 'http://localhost:8000/login/twitter/callback'
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),  // Your Facebook App ID
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'), // Your Facebook App Secret
        'redirect' => env('localhost:8000/twitter/callback'),
    ],
     'google' => [
        'client_id' => '701095251022-hri39lilt8q7vd9r4dd53gbk1n3ug8e9.apps.googleusercontent.com',
        'client_secret' => 'NRoZ6A1ge2MrzQYoBxas5-08',
        'redirect' => 'http://localhost/appoint/login/google/callback',
    ],

];
