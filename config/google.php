<?php

return [
    /*
    |----------------------------------------------------------------------------
    | Google application name
    |----------------------------------------------------------------------------
    */
    'application_name' => env('GOOGLE_APPLICATION_NAME', 'test api'),

    /*
    |----------------------------------------------------------------------------
    | Google OAuth 2.0 access
    |----------------------------------------------------------------------------
    |
    | Keys for OAuth 2.0 access, see the API console at
    | https://developers.google.com/console
    |
    */
    'client_id'       => env('GOOGLE_CLIENT_ID', '345992983001-07npo18cn3kmhmglrn8rot5b09pfbuug.apps.googleusercontent.com'),
    'client_secret'   => env('GOOGLE_CLIENT_SECRET', 'K6gQPaFtBfPG7n12b2v3g5qd'),
    'redirect_uri'    => env('GOOGLE_REDIRECT', 'http://localhost/nguyen/z11app/public/test'),
    'scopes'          => ['https://www.googleapis.com/auth/drive'],
    'access_type'     => 'offline',
    'approval_prompt' => 'force',

    /*
    |----------------------------------------------------------------------------
    | Google developer key
    |----------------------------------------------------------------------------
    |
    | Simple API access key, also from the API console. Ensure you get
    | a Server key, and not a Browser key.
    |
    */
    'developer_key' => env('GOOGLE_DEVELOPER_KEY', 'a7882abe556d0e845c3ef4ce3d84ad6008d7d84b'),

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
        'file' => env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION', 'F:\xampp\htdocs\nguyen\z11app\My Project-a7882abe556d.json')
    ],
];
