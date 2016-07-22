<?php

namespace DigitalVirgo\MPS\Model;

abstract class SmsAbstract extends MessageAbstract
{

    /**
     * @var string
     */
    protected $_directionValue;

    /**
     * @var string
     */
    protected $_operatorCode;

    /**
     * @var string
     */
    protected $_recipient;

    /**
     * @param string $directionValue
     */
    public function setDirectionValue($directionValue)
    {
        $this->_directionValue = $directionValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirectionValue()
    {
        return $this->_directionValue;
    }

    /**
     * @param string $operatorCode
     */
    public function setOperatorCode($operatorCode)
    {
        $this->_operatorCode = $operatorCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperatorCode()
    {
        return $this->_operatorCode;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient($recipient)
    {
        $this->_recipient = $recipient;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->_recipient;
    }

    /**
     * @return \DOMElement
     */
    protected function _prepareXml()
    {
        $message = parent::_prepareXml();

        $directionValue = $this->getDirectionValue();
        if (!empty($directionValue)) {
            $param = $this->_xml->createElement('directionValue', $directionValue);
            $message->appendChild($param);
        }

        $operatorCode = $this->getOperatorCode();
        if (!empty($operatorCode)) {
            $param = $this->_xml->createElement('operatorCode', $operatorCode);
            $message->appendChild($param);
        }

        $recipient = $this->getRecipient();
        if (!empty($recipient)) {
            $param = $this->_xml->createElement('recipient', $recipient);
            $message->appendChild($param);
        }

        return $message;
    }
}