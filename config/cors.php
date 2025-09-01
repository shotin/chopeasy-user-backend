<?php
return [
    'paths' => ['api/*', 'v1/*', 'login', 'register', 'auth/*', '*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:5173','https://chopwells.netlify.app/'],

    'allowed_headers' => ['*'],

    'supports_credentials' => true,
];
