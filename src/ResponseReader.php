<?php

namespace Kris\Floorplan;
use XMLReader;

class ResponseReader {

    public $responseXML;
    public $reader;
    
    public function __construct($responseXML)
    {
        $this->responseXML = $responseXML;
        $this->reader = new XMLReader();
    }

    public function getElementGroup(string $elementName) {
        $xml = [];
        
        $this->reader->XML($this->responseXML);
        while($this->reader->read()) {
            if($this->reader->nodeType == XMLReader::ELEMENT && $this->reader->name === $elementName) {
                array_push($xml, $this->reader->readOuterXml());
            }
        }

        while($this->reader->next($elementName)) {
           array_push($xml, $this->reader->readOuterXml());
        }

        $this->reader->close();
        return $xml;
    }

}