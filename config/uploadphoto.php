<?php
return [
    'auth' => [
        'api_key' => env('API_KEY', ''),
        'api_secret' => env('API_SECRET', ''),
        'oauth_token' => env('OAUTH_TOKEN', ''),
        'oauth_token_secret' => env('OAUTH_TOKEN_SECRET', ''),
    ],
    'host' => 'flickr',
];