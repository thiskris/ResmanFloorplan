<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Kris\Floorplan\ResManSettings;
use Kris\Floorplan\ResManV1Client;
use Kris\Floorplan\Property;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// User fills form, form input is stored in array or registry
$formSettings = [
    'BaseURL' => 'https://api.myresman.com/',
    'AccountID' => $_ENV['ACCOUNT_ID'],
    'Property' => 'Lemon Tree',
    'PropertyID' => $_ENV['PROPERTY_ID_ONE'],
];

// ResMan Settings are created in Settings instance
$settings = new ResManSettings($formSettings);

// Pass settings to API client
$apiClient = new ResManV1Client($settings);
//$response = $apiClient->fetchMarketing();

$start = round(microtime(true) * 1000);

$response = $apiClient->fetchMarketing();
$property = new Property($response);
$floorplans = $property->getUnits();

$end = round(microtime(true) * 1000);
$time = $end - $start;

echo "Time to fetch and set data: " . $time . "ms \n"; 
print_r($floorplans);






