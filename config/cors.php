<?php
return [
    'paths' => ['api/*', 'api/v1/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173', 'http://localhost:3000','http://localhost:8080','https://chopeasy.ng'],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
