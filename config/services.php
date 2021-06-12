<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT'),
    ],

    'recaptcha' => [
        'site_key' => env('reCAPTCHA_SITE_KEY'),
        'secret_key' => env('reCAPTCHA_SECRET_KEY'),
    ],

    'rajaongkir' => [
        'url' => env('RAJAONGKIR_API_URL'),
        'url_v2' => env('RAJAONGKIR_API_URL_V2'),
        'key' => env('RAJAONGKIR_API_KEY'),
    ],

    'jnt' => [
        'order' => [
            'url' => env('JNT_ORDER_URL'),
            'username' => env('JNT_ORDER_USERNAME'),
            'key' => env('JNT_ORDER_KEY'),
            'api_key' => env('JNT_ORDER_API_KEY'),
        ],
        'tarif' => [
            'url' => env('JNT_TARIF_URL'),
            'key' => env('JNT_TARIF_KEY'),
            'cusname' => env('JNT_TARIF_CUSNAME'),
        ],
        'track' => [
            'url' => env('JNT_TRACK_URL'),
            'username' => env('JNT_TRACK_USERNAME'),
            'password' => env('JNT_TRACK_PASSWORD'),
        ],
    ],

    'ncs' => [
        'url' => env('NCS_URL'),
        'username' => env('NCS_USERNAME'),
        'password' => env('NCS_PASSWORD'),
    ],

    'paypal' => [
        'client' => env('PAYPAL_CLIENT'),
    ],
];
