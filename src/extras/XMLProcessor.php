<?php

// To Do: implement reader parser floorplans/units xml as needed

use Kris\Floorplan\Marketing;

class MarketingReader {

    public XMLReader $cursor;
    public static $data = [];

    public function __construct(string $xmlString)
    {
        $this->cursor = new XMLReader();
        $this->cursor->xml($xmlString);
    }

    public function processFloorplans() {
        while($this->cursor->read()) {
            
            $this->setElementAttribute('id', 'Floorplan', 'IDValue');
            $this->setElementText('name', 'Name');
            $this->setElementText('comment', 'Comment');
            $this->setElementText('unitCount', 'UnitCount');
            $this->setElementText('unitsAvailable', 'UnitsAvailable');
            $this->setRooms();
            $this->setAttributes('sqft', 'SquareFeet');
            $this->setAttributes('effectiveRent', 'EffectiveRent');

        }
    }

    public function setElementAttribute($key, $elementName, $attributeName) {
        if($this->cursor->nodeType == XMLReader::ELEMENT && $this->cursor->localName === $elementName) {
            if($this->cursor->localName == 'Floorplan') {
                MarketingReader::$data[$key] = $this->cursor->getAttribute($attributeName);
            }
        }
    }

    public function setElementText($key, $elementName) {
            if($this->cursor->nodeType == XMLReader::ELEMENT && $this->cursor->localName === $elementName) {
                $this->cursor->read();
                MarketingReader::$data[$key] = $this->cursor->value;
        }
    }

    public function setAttributes($key, $elementName) {
        if($this->cursor->nodeType == XMLReader::ELEMENT && $this->cursor->localName === $elementName) {
            if($this->cursor->hasAttributes) {
                while($this->cursor->moveToNextAttribute()) {
                    MarketingReader::$data[$key][$this->cursor->name] = $this->cursor->value;
                }
            }
        }
    }

    public function setRooms() {
 
            $data = [];

            if($this->cursor->nodeType == XMLReader::ELEMENT && $this->cursor->localName === 'Room') {
                $roomType = $this->cursor->getAttribute('RoomType');
                
                while($this->cursor->read()) {
                    if($this->cursor->nodeType == XMLReader::TEXT && $this->cursor->localName === 'Count') {
                        $data[$roomType] = $this->cursor->value;
                        break;
                    }
                }
            }  
    }

}
