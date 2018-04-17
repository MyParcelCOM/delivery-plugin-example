<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Show the homepage with the popup button.
$app->get('/', function (Request $request, Response $response) {
    return $this->renderer->render($response, 'index.phtml');
});

// The route to retrieve new pick-up and drop-off locations.
$app->get('/locations/{countryCode}/{postalCode}', function (Request $request, Response $response, array $arguments) {
    // The postal code and country code are passed as path variables and retrieved from the arguments.
    $countryCode = $arguments['countryCode'];
    $postalCode = $arguments['postalCode'];

    // Get the locations through the authenticated API instance.
    $locations = $this->api->getPickUpDropOffLocations($countryCode, $postalCode);

    // Merge all the locations to a single array.
    $allLocations = array_reduce($locations, function (array $combinedLocations, $carrierLocations) {
        // If the locations for a specific carriers is `null`, it means there was an error retrieving them.
        if ($carrierLocations === null) {
            return $combinedLocations;
        }

        /** @var \MyParcelCom\ApiSdk\Collection\CollectionInterface $carrierLocations */
        return array_merge($combinedLocations, $carrierLocations->get());
    }, []);

    // Pass through retrieved locations as a json response.
    return $response->withJson([
        'data' => $allLocations,
    ]);
});

// The route to retrieve available carriers.
$app->get('/carriers', function (Request $request, Response $response, array $arguments) {
    // Get the carriers through the authenticated API instance.
    $carriers = $this->api->getCarriers()->get();

    // Pass through retrieved carriers as a json response.
    return $response->withJson([
        'data' => $carriers,
    ]);
});
