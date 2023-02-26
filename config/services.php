<?php

return [

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
        'client_id' => '581571273776-l7db3vblavqlv01m52n0oasb7nkcbp3v.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://worldcarrental.com/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '4873989266001068', // 15 karakterli Facebook uygulamasının "App ID"si
        'client_secret' => 'c625ea292303f52cec0e7fa72ced25b0', // 32 karakteli Facebook uygulamasının "App Secret"ı
        'redirect' => 'https://worldcarrental.com/auth/facebook/callback', // .env file'da APP_URL belirtilmiş ise onu çek, belirtilmemiş ise  localhost olarak kabul et
    ],
];


