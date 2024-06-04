<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Psr7\Response;
use Kris\Floorplan\Domain\ResManAccount;
use Kris\Floorplan\InterfaceAdapters\ApiService;

if (php_sapi_name() !== 'cli') {
    die("This script can only be run from the command line.");
}

$ResManApi = new ApiService();
$properties = null;

while(true) {

    $command = readline();
    switch ($command) {
        case 'enable': echo 'Enter AccountID: ';
                        $accountId = readline();
                        $properties = ResManAccount::getProperties($accountId, $ResManApi);
                        if($properties['Status'] === 'Failed') {
                            echo 'Invalid Account';
                            break;
                        } else {
                            static $account = new ResManAccount($accountId, null, null);
                            
                                echo "found " . count($properties['Properties']) . " properties";
                                echo "\n";
                                echo "Select by Name \n";
                            
                            foreach($properties['Properties'] as $option) {
                                echo "\n";
                                echo "Property name: " . $option['Name'] . "\n";
                                echo "Property ID: " . $option['PropertyID'] . "\n";
                                echo "\n";  
                            }
                        } 
                       break;
        case 'select':  echo 'enter name: ';
                        $name = readline();
                        $account->setProperty($properties['Properties'], $name);
                        break;
        case 'show account' : $account->get();
                                break;
        case 'show property' : $response = $ResManApi->fetchMarketing($account->accountId, $account->propertyId);
                                var_dump($response);
                                break;                                                                           
        case 'exit'  : break;
        default : 'not working';
        break;                
    }
}