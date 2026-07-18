<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Real API connection
    |--------------------------------------------------------------------------
    |
    | Keep this false while the production API is not connected. In that state,
    | every public URL shows the Coming Soon page. Change the environment value
    | to true after the real API is connected to restore the full website.
    |
    */
    'api_connected' => env('REAL_API_CONNECTED', false),
];
