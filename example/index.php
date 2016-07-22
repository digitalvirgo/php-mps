<?php

require_once 'vendor/autoload.php';

use DigitalVirgo\MPS\Model\SmsText;
use DigitalVirgo\MPS\Service\ClientRest;
use DigitalVirgo\MPS\Service\ClientSoap;

$sms = new SmsText([
    'deliveryRequest' => 3,
    'sender' => '7772',
    'recipient' => '48500000000',
    'text' => 'test message',
    'operatorCode' => 26003,
    'billCode' => SmsText::BILL_FREE,
    'category' => SmsText::CATEGORY_GAME,
    'directionValue' => SmsText::DIRECTION_OUT,
    'sendDate' => new \DateTime(),
]);

/** SOAP EXAMPLE */
$client = new ClientSoap('test', 'RHA/4jFit!');

var_dump(
    $client->put($sms, SmsText::DELIVERY_REPORT_MOBILE_END_USER)
);

/** REST EXAMPLE */

$client = ClientRest::getInstance('https://demo.partners.avantis.pl');

$client
    ->setUsername('test')
    ->setPassword('RHA/4jFit!');


var_dump($client->sendMessage($sms));

