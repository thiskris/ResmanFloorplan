<?php

namespace Kris\Floorplan;

class FloorPlanController {
    
    private $ApiClient;

    public function __construct(FloorPlanClient $ApiClient) {
        $this->ApiClient = $ApiClient;
    }

    public function getFloorPlans() {   
        return $this->ApiClient->fetchFloorPlans();
    }

}