<?php

namespace DigitalVirgo\MPS\Service;

use DigitalVirgo\MPS\Model\MessageAbstract;
use GuzzleHttp\Client as GuzzleClient;

class ClientRest extends GuzzleClient
{

    private static $_instance = null;

    protected $defaults;

    protected $_username;
    protected $_password;

    /**
     * Setup basic auth
     *
     * @return null
     */
    protected function _configureAuth()
    {
        if ($this->_username && $this->_password) {
            $this->setDefaultOption('auth', [$this->_username, $this->_password]);
        }
    }

    /**
     * @return null | ClientRest
     */
    public static function getInstance($baseUrl)
    {
        if (null === static::$_instance) {

            static::$_instance = new static(array(
                'base_url' => $baseUrl,
                'defaults' => array(
                    'headers' => array(
                        'Content-type' => 'application/x-www-form-urlencoded'
                    )
                )
            ));

            static::$_instance->setDefaultOption('verify', false);
        }

        return static::$_instance;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        $this->_configureAuth();

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
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        $this->_configureAuth();
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

        $message->setUsername($this->getUsername());
        $message->setPassword($this->getPassword());

        $message->validate();

        $xml = $message->toXml();

        $stream = \GuzzleHttp\Stream\Stream::factory($xml);

        $response = $this->post('/mpsml-adapters/message', array(
            'body' => $stream
        ));

        /** @var \GuzzleHttp\Stream\Stream $body */
        $body = $response->getBody();

        if ($response->getStatusCode() == 200) {

            $responseXml = simplexml_load_string($body);
            if ((string)$responseXml->responseStatus == '200') {
                return (string)$responseXml->messageID;
            } else {
                throw new \Exception('Unable to send message: ['.$response->getStatusCode().'] '.$body->getContents());
            }
        } else {
            throw new \Exception('Unable to send message: ['.$response->getStatusCode().'] '.$body->getContents());
        }
    }

}