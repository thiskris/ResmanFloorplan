<?php

namespace Kris\Floorplan;

class ResManSettings {

    private string $apiBaseUrl;
    private string $accountId;
    private string $propertyName;
    private string $propertyId;
    
    public function __construct(array $formSettings) {
        $this->apiBaseUrl = $formSettings['BaseURL'];
        $this->accountId = $formSettings['AccountID'];
        $this->propertyName = $formSettings['Property'];
        $this->propertyId = $formSettings['PropertyID'];
    }

    public function getSettings() : array {
        return [
            'apiBaseUrl' => $this->apiBaseUrl,
            'accountId' => $this->accountId,
            'propertyName' => $this->propertyName,
            'propertyId' => $this->propertyId,
        ];
    }

    public function getBaseUrl() {
        return $this->apiBaseUrl;
    }

    public function getAccountId() {
        return $this->accountId;
    }

    public function getPropertyId() {
        return $this->propertyId;
    }

    public function remove() {}

}