<?php 

return [
    /*
    |--------------------------------------------------------------------------
    | Allowed CORS Routes
    |--------------------------------------------------------------------------
    |
    | This defines the routes where CORS headers will be applied. You can
    | specify specific routes, such as 'api/*' or 'vue/*', or leave it
    | as '*' to apply to all routes.
    |
    */
    'paths' => ['api/*', 'vue/*'],

    /*
    |--------------------------------------------------------------------------
    | Allowed HTTP Methods
    |--------------------------------------------------------------------------
    |
    | Define the allowed HTTP methods for CORS requests. You can set this
    | to ['*'] to allow all methods (GET, POST, PUT, DELETE, etc.).
    |
    */
    'allowed_methods' => ['*'], // Allow all HTTP methods

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins
    |--------------------------------------------------------------------------
    |
    | Here you define the allowed origins for cross-origin requests. This
    | should match the URL where your frontend (Vue app) is hosted.
    |
    */
    'allowed_origins' => ['http://localhost:5173'], // Allow requests from this origin

    /*
    |--------------------------------------------------------------------------
    | Allowed Headers
    |--------------------------------------------------------------------------
    |
    | Define which headers are allowed to be sent in requests.
    |
    */
    'allowed_headers' => ['*'], // Allow all headers

    /*
    |--------------------------------------------------------------------------
    | Exposed Headers
    |--------------------------------------------------------------------------
    |
    | Define which headers are exposed to the frontend.
    |
    */
    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | Max Age
    |--------------------------------------------------------------------------
    |
    | Define the maximum age for which the CORS headers are cached by the
    | browser.
    |
    */
    'max_age' => 0,

    /*
    |--------------------------------------------------------------------------
    | Supports Credentials
    |--------------------------------------------------------------------------
    |
    | Determine if cookies or other credentials can be included with the
    | requests.
    |
    */
    'supports_credentials' => false,
];



?>