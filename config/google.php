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

    'client_id'       => env('GOOGLE_CLIENT_ID', '1084347997582-4mvbpdda81bv32075rkclimghf3bv2lf.apps.googleusercontent.com'),
    'client_secret'   => env('GOOGLE_CLIENT_SECRET', 'KO81-sm-0TrNPwQSBMvANOB2'),
    'redirect_uri'    => env('GOOGLE_REDIRECT', 'http://localhost/z11app/public/upload'),
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

    'developer_key' => env('GOOGLE_DEVELOPER_KEY', '7282f09f2b9b096099913ab0055d715075fc2f94'),


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

        'file' => env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION', '/drive/elearning.json')

    ],
];
