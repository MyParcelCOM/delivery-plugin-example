<?php

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];

    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// API instance
$container['api'] = function ($c) {
    // Load a MyParcelComApi instance.
    $api = new \MyParcelCom\ApiSdk\MyParcelComApi(
        $c->get('settings')['myparcelcom_api_url']
    );

    // Pass your authentication credentials.
    $authenticator = new \MyParcelCom\ApiSdk\Authentication\ClientCredentials(
        $c->get('settings')['myparcelcom_credentials']['client_id'],
        $c->get('settings')['myparcelcom_credentials']['client_secret'],
        $c->get('settings')['myparcelcom_auth_url']
    );
    $api->authenticate($authenticator);

    return $api;
};
