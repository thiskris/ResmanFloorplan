<?php

$xml_file = "marketing.xml";
$xml_content = file_get_contents($xml_file);

$start = round(microtime(true) * 1000);

$xml = simplexml_load_string($xml_content);




$Property = $xml->Response->PhysicalProperty->Property;
foreach($Property->Floorplan as $flooplan) {

}

$end = round(microtime(true) * 1000);
$time = $end-$start;

echo $time . "Ms";



            // foreach($Property->Floorplan as $floorplan) {
            //     $floorplanData = [
            //         'idValue' => (string) $floorplan['IDValue'],
            //         'name' => (string) $floorplan->Name,
            //         'unitsAvailable' => (int) $floorplan->UnitsAvailable,
            //         'rooms' => [],
            //         'squareFeet' => (string) $floorplan->SquareFeet['Avg'],
            //         'effectiveRent' => (string) $floorplan->EffectiveRent['Avg'],
            //         'floorPlan' => []
            //     ];

            //     foreach($floorplan->Room as $room) {
            //         $floorplanData['rooms'][] = [
            //             'roomType' => (string) $room['RoomType'],
            //             'count' => (float) $room->Count,
            //         ];
            //     }

            //     foreach($floorplan->File as $file) {
            //         $fileType = (string) $file->FileType;
            //         if($fileType === 'Floorplan') {
            //             $floorplanData['floorPlan'][] = [
            //                 'name' => (string) $file->Name,
            //                 'src' => (string) $file->Src,
            //             ];
            //         }
            //     }

            //     array_push($marketing['floorplans'], $floorplanData);
                
            // }

            // foreach($Property->ILS_Unit as $ilsUnit) {
            //     $unit = $ilsUnit->Units->Unit;
                
            //     $unitData = [
            //         'idValue' => (string) $unit->Identification['IDValue'],
            //         'unitType' => (string) $unit->UnitType,
            //         'unitBedrooms' => (int) $unit->UnitBedrooms,
            //         'unitBathrooms' => (int) $unit->UnitBathrooms,
            //         'minSqFt' => (int) $unit->MinSquareFeet,
            //         'maxSqFt' => (int) $unit->MaxSquareFeet,
            //         'marketRent' => (int) $unit->MarketRent,
            //         'floorplanName' => (string) $unit->FloorplanName,
            //         'unitLeasedStatus' => (string) $unit->UnitLeasedStatus
            //     ];

            //     array_push($marketing['units'], $unitData);
            // }

            // print_r($marketing);