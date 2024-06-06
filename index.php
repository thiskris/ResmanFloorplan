<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Kris\Floorplan\ResManSettings;
use Kris\Floorplan\FloorPlanClient;
use Kris\Floorplan\FloorPlanController;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// User fills form, form input is stored in array or registry
$formSettings = [
    'BaseURL' => 'https://api.myresman.com/',
    'AccountID' => '800',
    'Property' => 'Lemon Tree',
    'PropertyID' => $_ENV['PROPERTY_ID_ONE'],
];

// ResMan Settings are created in Settings instance
$settings = new ResManSettings($formSettings);

// Pass settings to FloorPlan API client
$ApiClient = new FloorPlanClient($settings);

// var_dump($ApiClient);

// // Pass API Client to Floor plan Controller
$FloorPlanController = new FloorPlanController($ApiClient);
$response = $FloorPlanController->getFloorPlans();
$property = $response['Response']['PhysicalProperty']['Property'];

foreach($property as $key => $value) {
    if($key === 'Floorplan')
        print_r($value);
}