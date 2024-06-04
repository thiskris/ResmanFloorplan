<?php

namespace Kris\Floorplan\Domain;

use Exception;
use Kris\Floorplan\InterfaceAdapters\ApiService;

class ResManAccount {

    public string $accountId;
    public ?string $propertyId;
    public ?string $name;

    public function __construct($accountId, $propertyId, $name)
    {
        $this->accountId = $accountId;
        $this->propertyId = $propertyId;
        $this->name = $name;
    }

    public static function getProperties(string $accountId, ApiService $apiService) {
        $response = $apiService->fetchProperties($accountId);
        if(! isset($response) || $response['Status'] === 'Failed') {
            return [
                'Status' => 'Failed'
            ];            
        }
        return $response;
    }

    public function setProperty(array $options, string $propertyName) {
        foreach($options as $option) {
            if($option['Name'] === $propertyName) {
                $this->name = $option['Name'];
                $this->propertyId = $option['PropertyID'];
            }
        }
    }

    public function get() {
        echo "accoundid: " . $this->accountId . "\n";
        echo "propertyid: " . $this->propertyId . "\n";
        echo "property name: " . $this->name . "\n";
    }
}