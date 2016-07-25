<?php

namespace DigitalVirgo\MPS\Service;

use DigitalVirgo\MPS\Model\MessageAbstract;
use DigitalVirgo\MPS\Model\PlainTextCredentials;


class ClientSoap extends \SoapClient
{
    const WSDL_URL = 'https://demo.partners.avantis.pl/mpsml-adapters/services/MPSLocal2?wsdl';

    public static $classmap = array(
        'Message'              => 'DigitalVirgo\MPS\Model\MessageAbstract',
        'SMSText'              => 'DigitalVirgo\MPS\Model\SmsText',
        'PlainTextCredentials' => 'DigitalVirgo\MPS\Model\PlainTextCredentials'
    );

    protected $_credentials;

    public function __construct($username, $password)
    {
        $this->_credentials = new PlainTextCredentials(array(
            'login'    => $username,
            'password' => $password
        ));

        return parent::__construct(self::WSDL_URL, array(
            'classmap' => self::$classmap
        ));
    }

    /**
     * @param MessageAbstract $message
     * @param int $deliveryReport
     * @return Response
     */
    public function put(MessageAbstract $message, $deliveryReport)
    {
        return parent::put($message, $this->_credentials, $deliveryReport);
    }

}