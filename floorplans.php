<?php

require __DIR__ . '/index.php';
$xml = $Property->getFloorplans();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
<title>FloorPlans</title>
</head>
<body>
<div class="main">    
<div class="container">
    <?php foreach ($xml->xmlContent->Floorplan as $floorplan):
        $imageName = null; 
        $imageSrc = null;
        $qtyBedrooms = 0;
        $qtyBathrooms = 0;

        foreach($floorplan->Room as $room) {
            $type = (string) $room['RoomType'];
            if($type === 'Bedroom') {
                $qtyBedrooms = (int) $room->Count;
            } else if ($type === 'Bathroom') {
                $qtyBathrooms = (int) $room->Count;
            }
        }

        foreach($floorplan->File as $file) {
            $type = (string) $file->FileType;
            if($type === 'Floorplan') {
                $imageName = (string) $file->Name;
                $imageSrc = (string) $file->Src;
                break;
            }
        }

    ?>        
        <div class="card">
            <div class="card-body">
                <div class="card-img-container">
                <?php if(is_null($imageSrc)) {
                    echo '<div class="card-no-img">Image Unavailable</div>';
                } else {
                    echo '<img src="' . $imageSrc . '" alt="Card Image">';
                }
                    ?>
                </div>
                <div class="card-details">
                    <div class="card-main">
                        <div class="card-rooms"><?php echo $qtyBedrooms . 'BR /' . $qtyBathrooms . 'B'?></div>
                        <div class="card-sqft"><?php echo $floorplan->SquareFeet['Min'] . ' - ' . $floorplan->SquareFeet['Max'] . 'sqft'?></div>
                        <div class="card-availability"><?php echo $floorplan->UnitsAvailable . ' Available' ?></div>
                    </div>
                    <div class="card-pricing">
                        <div>Starting at</div>
                        <div><?php echo '$' . $floorplan->MarketRent['Min']?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>   
    </div>
</div>
</body>
</html>