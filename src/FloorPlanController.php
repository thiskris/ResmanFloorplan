<?php

namespace Kris\Floorplan;

use Kris\Floorplan\Marketing as FloorplanMarketing;

class FloorPlanController {
    
    private $client;

    public function __construct(ResManV1Client $client) {
        $this->client = $client;
    }

    public function getFloorplans() {   
        $XMLContent = $this->client->fetchMarketing();
        return new FloorplanMarketing($XMLContent);
    }

}