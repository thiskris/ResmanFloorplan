<?php

namespace Kris\Floorplan\InterfaceAdapters;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiConfig {
    const PARTNER_ID = null;
    const API_KEY = null;
};

class ApiService {
    
    private Client $client; 

    public function __construct()
    {
        $this->client = new Client();
    }
 
    public function fetchProperties(string $accountId) {
        
        try {
            $response = $this->client->post('https://api.myresman.com/Account/GetProperties', [
                'form_params' => [
                    'IntegrationPartnerID' => ApiConfig::PARTNER_ID,
                    'ApiKey' => ApiConfig::API_KEY,
                    'AccountID' => $accountId,
                ]
            ]);

            $responseBody = $response->getBody()->getContents();
            return json_decode($responseBody, true);

        } catch (RequestException $e) {
            $e->getMessage();
        }
        
        
    }

    public function fetchMarketing(string $accountId, string $propertyId) {
        try {
            
            $response = $this->client->post('https://api.myresman.com/MITS/GetMarketing4_0', [
                'form_params' => [
                    'IntegrationPartnerID' => ApiConfig::PARTNER_ID,
                    'ApiKey' => ApiConfig::API_KEY,
                    'AccountID' => $accountId,
                    'PropertyID' => $propertyId,
                ]
            ]);

            $responseBody = $response->getBody()->getContents();
            return $responseBody;

        } catch(RequestException $e) {
            $e->getMessage();
        }
    }
}


