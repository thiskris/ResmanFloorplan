<?php


$start = round(microtime(true) * 1000);

$xml = new XMLReader();
$xml->open('marketing.xml');


while($xml->read()) {
    
    if($xml->nodeType == XMLReader::ELEMENT && $xml->name === 'Floorplan') {
       echo $xml->readOuterXML();
        break;
    }
}

while($xml->next('Floorplan')) {
      echo $xml->readOuterXml();
}

$xml->close();

$end = round(microtime(true) * 1000);

$time = $end - $start;

echo $time . "ms";