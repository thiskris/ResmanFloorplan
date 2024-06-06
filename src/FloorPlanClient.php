<?php

namespace Kris\Floorplan;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Dotenv\Dotenv;


require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class FloorPlanClient {
    
    private $settings;

    public function __construct(ResManSettings $settings)
    {
        $this->settings = $settings;
    }

    public function fetchFloorPlans() {
        try {
            $client = new Client();
            $baseUrl = $this->settings->getBaseUrl();
            $response = $client->post("{$baseUrl}/MITS/GetMarketing4_0", [
                'form_params' => [
                    'IntegrationPartnerID' => $_ENV['PARTNER_ID'],
                    'ApiKey' => $_ENV['API_KEY'],
                    'AccountID' => $this->settings->getAccountId(),
                    'PropertyID' => $this->settings->getPropertyId(),
                ]
            ]);

            $responseBody = $response->getBody()->getContents();
            
            $xml = simplexml_load_string($responseBody);
            $array = json_decode(json_encode($xml), true);
            return $array;

        } catch(RequestException $e) {
            $e->getMessage();
        }
    }
}