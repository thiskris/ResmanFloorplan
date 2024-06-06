<?php

namespace Kris\Floorplan\InterfaceAdapters;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class ApiService {

    public static function fetchProperties() {
        
        try {
            $client = new Client();
            $response = $client->post('https://api.myresman.com/Account/GetProperties', [
                'form_params' => [
                    'IntegrationPartnerID' => $_ENV['PARTNER_ID'],
                    'ApiKey' => $_ENV['API_KEY'],
                    'AccountID' => $_ENV['ACCOUNT_ID'],
                ]
            ]);

            $responseBody = $response->getBody()->getContents();
            return json_decode($responseBody, true);

        } catch (RequestException $e) {
            $e->getMessage();
        }
        
        
    }

    public static function fetchMarketing() {
        
        try {
            $client = new Client();
            $response = $client->post('https://api.myresman.com/MITS/GetMarketing4_0', [
                'form_params' => [
                    'IntegrationPartnerID' => $_ENV('PARTNER_ID'),
                    'ApiKey' => $_ENV('API_KEY'),
                    'AccountID' => null,
                    'PropertyID' => null,
                ]
            ]);

            $responseBody = $response->getBody()->getContents();
            return $responseBody;

        } catch(RequestException $e) {
            $e->getMessage();
        }
    }
}

$propterties = ApiService::fetchProperties();
var_dump($propterties);
