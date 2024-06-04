<?php

namespace Kris\Floorplan\Domain;

interface FPRepositoryInterface {
    public function getFloorPlans(string $propertyId); 
}