<?php

// Load environment variables.
(new \Dotenv\Dotenv(__DIR__ . '/../'))->load();

return [
    'settings' => [
        'displayErrorDetails'    => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer'               => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        'myparcelcom_api_url' => getenv('API_URL'),
        'myparcelcom_auth_url' => getenv('AUTH_URL'),

        'myparcelcom_credentials' => [
            'client_id'     => getenv('CLIENT_ID'),
            'client_secret' => getenv('CLIENT_SECRET'),
        ],
    ],
];
