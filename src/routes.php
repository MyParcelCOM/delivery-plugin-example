<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Show the homepage with the popup button.
$app->get('/', function (Request $request, Response $response) {
    return $this->renderer->render($response, 'index.phtml');
});

// The route to retrieve new Pickup Dropoff Locations.
$app->get('/locations/{countryCode}/{postalCode}', function (Request $request, Response $response, array $arguments) {
    // The postal code and country code are passed as path variables and retrieved from the request object.
    $countryCode = $arguments['countryCode'];
    $postalCode = $arguments['postalCode'];

    // Load a MyParcelComApi instance.
    $api = new \MyParcelCom\Sdk\MyParcelComApi(
        $this->get('settings')['myparcelcom_api_url']
    );

    // Pass your authentication credentials.
    $authenticator = new \MyParcelCom\Sdk\Authentication\ClientCredentials(
        $this->get('settings')['myparcelcom_credentials']['client_id'],
        $this->get('settings')['myparcelcom_credentials']['client_secret'],
        $this->get('settings')['myparcelcom_auth_url']
    );
    $api->authenticate($authenticator);

    // Get the Pickup Dropoff Locations through the sdk.
    $locations = $api->getPickUpDropOffLocations($countryCode, $postalCode);

    // Pass through retrieved locations as a json response.
    return $response->withJson([
        'data' => $locations
    ]);
});
