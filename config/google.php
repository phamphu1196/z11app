<?php

return [
    /*
    |----------------------------------------------------------------------------
    | Google application name
    |----------------------------------------------------------------------------
    */
    'application_name' => env('GOOGLE_APPLICATION_NAME', 'Z11App'),

    /*
    |----------------------------------------------------------------------------
    | Google OAuth 2.0 access
    |----------------------------------------------------------------------------
    |
    | Keys for OAuth 2.0 access, see the API console at
    | https://developers.google.com/console
    |
    */
    'client_id'       => env('GOOGLE_CLIENT_ID', '1084347997582-pighdbjdcek0mj3screjp27ce6objot7.apps.googleusercontent.com'),
    'client_secret'   => env('GOOGLE_CLIENT_SECRET', 'PNXuK3vPkUlXoXErMNzbGdF0'),
    'redirect_uri'    => env('GOOGLE_REDIRECT', '["urn:ietf:wg:oauth:2.0:oob","http://localhost"]'),
    'scopes'          => ['https://www.googleapis.com/auth/drive','https://www.googleapis.com/auth/drive.metadata'],
    'access_type'     => 'online',
    'approval_prompt' => 'auto',

    /*
    |----------------------------------------------------------------------------
    | Google developer key
    |----------------------------------------------------------------------------
    |
    | Simple API access key, also from the API console. Ensure you get
    | a Server key, and not a Browser key.
    |
    */
    'developer_key' => env('GOOGLE_DEVELOPER_KEY', 'c8df7b49652f1cb70526ae62777be1ed5700cc27'),

    /*
    |----------------------------------------------------------------------------
    | Google service account
    |----------------------------------------------------------------------------
    |
    | Set the credentials JSON's location to use assert credentials, otherwise
    | app engine or compute engine will be used.
    |
    */
    'service' => [
        /*
        | Enable service account auth or not.
        */
        'enable' => env('GOOGLE_SERVICE_ENABLED', false),

        /*
        | Path to service account json file
        */
        'file' => env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION', '')
    ],
];
