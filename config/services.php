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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'farazsms' => [
        'key' => env('FARAZSMS_API_KEY')
    ],

    'ahanmelal' => [
        'rebar' => [
            'days_iteration' => 30,
            'table_head' => [
                'product_name' => ["نوع میلگرد"],
                'product_type' => ["حالت"],
                'product_analyze' => ["آنالیز"],
                'product_weight' => ["وزن"],
                'product_unit_of_measurement' => ["واحد"],
                'product_loading_place' => ["بارگیری"],
                'product_size' => ["سایز"],
                'product_price_today' => ["قیمت (تومان)"],
            ]
        ]
    ]

];