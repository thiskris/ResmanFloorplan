<?php

$xml = simplexml_load_file("example.xml");




foreach($xml->Property->Floorplan as $floorplan) {
    print_r($floorplan);
}

