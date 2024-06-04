<?php

namespace Kris\Floorplan\Infrastructure;

use Kris\Floorplan\Domain\FPRepositoryInterface;
use Kris\Floorplan\InterfaceAdapters\ApiService;

class FloorPlanRepository implements FPRepositoryInterface 
{
    public array $floorplans;
    private ApiService $resManApi;

    public function __construct()
    {
        $this->floorplans = [];
        $this->resManApi = new ApiService();
    }

    public function getFloorPlans(string $pro) {}

    public function load(array $floorplans) {
        $this->floorplans = $floorplans;
    }


}