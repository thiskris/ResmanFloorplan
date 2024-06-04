<?php

namespace Kris\Floorplan\Application;

use Kris\Floorplan\Domain\FPRepositoryInterface;
use Kris\Floorplan\Domain\ResManAccount;

class FloorPlanService {
     
    private FPRepositoryInterface $floorPlanRepository;

    public function __construct(FPRepositoryInterface $floorPlanRepository) {
        $this->floorPlanRepository = $floorPlanRepository;
    }

    public function getFloorPlans(string $propertyId) {
        return $this->floorPlanRepository->getFloorPlans($propertyId);
    }
}