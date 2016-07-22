<?php

namespace DigitalVirgo\MPS\Service;

use DigitalVirgo\MPS\Model\MessageAbstract;
use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient
{

    private static $_instance = null;

    protected $_url;
    protected $_username;
    protected $_password;

    /**
     * @return null | MPSClient
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            $config = \Zend_Registry::get('config');

            $username = $config['mps']['username'];
            $password = $config['mps']['password'];



            static::$_instance = new static(array(
                'base_url' => $config['mps']['url'],
                'defaults' => array(
                    'headers' => array(
                        'Content-type', 'application/x-www-form-urlencoded'
                    ),
                    'auth' => [$username, $password]
                )
            ));

            static::$_instance->setDefaultOption('verify', false);
            static::$_instance->setUsername($username);
            static::$_instance->setPassword($password);
        }

        return static::$_instance;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }


    public function sendMessage(MessageAbstract $message)
    {
        $xml = $message->toXml();

        $logger = \Zend_Registry::get('Logger');
        $logger->info('Send SMS: ' . $xml);

        $stream = \GuzzleHttp\Stream\Stream::factory($xml);

        $response = $this->post('/mpsml-adapters/message', array(
            'body' => $stream
        ));

        /** @var \GuzzleHttp\Stream\Stream $body */
        $body = $response->getBody();

        if ($response->getStatusCode() == 200) {
            $responseXml = simplexml_load_string($body);
            if ((string)$responseXml->responseStatus == '200') {
                return $responseXml->messageID;
            } else {
                throw new \Exception('Unable to send message: ['.$response->getStatusCode().'] '.$body->getContents());
            }
        } else {
            throw new \Exception('Unable to send message: ['.$response->getStatusCode().'] '.$body->getContents());
        }
    }

}