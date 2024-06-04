<?

namespace Kris\Floorplan\InterfaceAdapters;

use Kris\Floorplan\Application\FloorPlanService;
use Kris\Floorplan\Infrastructure\FloorPlanRepository;

class FloorplanController {

    private FloorPlanService $service; 

    public function __construct()
    {
        $floorPlanRepository = new FloorPlanRepository();
        $this->service = new FloorPlanService($floorPlanRepository);
    }

    public function getFloorPlans($propertyId) {
        return $this->service->getFloorPlans($propertyId);
    }
    
}