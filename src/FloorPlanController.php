<?php

namespace Kris\Floorplan;

class FloorPlanController {
    
    private $client;

    public function __construct(ResManV1Client $client) {
        $this->client = $client;
    }

    public function getFloorplans() {   
        $XMLContent = $this->client->fetchMarketing();
    }

}