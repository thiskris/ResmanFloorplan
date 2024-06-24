<?php
namespace Kris\Floorplan;

//require_once '../vendor/autoload.php';

use Kris\Floorplan\ResponseReader;
use SimpleXMLElement;

class Property {

    public $reader;

    public function __construct($responseXML)
    {
        $this->reader = new ResponseReader($responseXML);
    }

    public function getFloorplans() {
        $xmlElement = $this->reader->getElementGroup('Floorplan');

        $floorplans = [];

        foreach($xmlElement as $floorplan) {
            $xml = new SimpleXMLElement($floorplan);

            $imgSrc = null;
            $imgName = null;

            if((string)$xml->File->FileType === 'Floorplan') {
                $imgSrc = (string) $xml->File->Src;
                $imgName = (string) $xml->File->Name;
            }


            array_push($floorplans, [
                'id' => (string) $xml->attributes()->IDValue,
                'name' => (string) $xml->Name,
                'comment' => (string) $xml->Comment,
                'unitCount' => (int) $xml->UnitCount,
                'unitsAvailable' => (int) $xml->UnitsAvailable,
                'bedroom' => (float) $xml->Room[0]->Count,
                'bathroom' => (float) $xml->Room[1]->Count,
                'sqft' => [
                    'min' => (int) $xml->SquareFeet->attributes()->Min,
                    'avg' => (int) $xml->SquareFeet->attributes()->Avg,
                    'max' => (int) $xml->SquareFeet->attributes()->Max,
                ],
                'marketRent' => [
                    'min' => (int) $xml->MarketRent->attributes()->Min,
                    'max' => (int) $xml->MarketRent->attributes()->Max,
                ],
                'effectiveRent' => [
                    'min' => (int) $xml->EffectiveRent->attributes()->Min,
                    'avg' => (int) $xml->EffectiveRent->attributes()->Avg,
                    'max' => (int) $xml->EffectiveRent->attributes()->Max,
                ],
                'img' => $imgSrc,
                'imgName' => $imgName,
            ]);
        }
        return $floorplans;
    }

    public function getUnits() {
        $xmlElements = $this->reader->getElementGroup('ILS_Unit');

        $units = [];

        foreach($xmlElements as $ILS_unit) {
            $xml = new SimpleXMLElement($ILS_unit);
            $unit = $xml->Units->Unit;

            array_push($units, [
                    'id' => (string) $xml->attributes()->IDValue,
                    'minSqft' => (int) $unit->MinSquareFeet,
                    'maxSqft' => (int) $unit->MaxSquareFeet,
                    'bedrooms' => (int) $unit->UnitBedrooms,
                    'bathrooms' => (float) $unit->UnitBathrooms,
                    'marketRent' => (int) $unit->MarketRent,
                    'vacancyStatus' => (string) $unit->UnitOccupancyStatus,
                    'floorplanName' => (string) $unit->FloorplanName,
                    'BuildingName' => (string) $unit->BuildingName,
                    'effectiveRent' => [
                        'min' => (int) $xml->EffectiveRent->attributes()->Min,
                        'avg' => (int) $xml->EffectiveRent->attributes()->Avg,
                        'max' => (int) $xml->EffectiveRent->attributes()->Max,
                    ], 
                    'floorLevel' => (int) $xml->FloorLevel,
            ]);
        }
        return $units;
    }
}



