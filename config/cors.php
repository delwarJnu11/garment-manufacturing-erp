<?php

return [

    'paths' => ['api/*', 'vue/*', 'sanctum/csrf-cookie'],
    'allowed_origins_patterns' => [],
    'supports_credentials' => false,
    'allowed_methods' => ['*'], // Allow all HTTP methods
    'allowed_origins' => ['http://localhost:5173', '*'], // Allow requests from this origin
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0
];



?>
