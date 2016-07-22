<?php

namespace DigitalVirgo\MPS\Model;

abstract class SmsAbstract extends MessageAbstract
{

    const DIRECTION_UNDEFINED = 0;
    const DIRECTION_IN        = 1;
    const DIRECTION_OUT       = 2;
    const DIRECTION_INTERNAL  = 3;

    /**
     * @var string
     */
    protected $_directionValue = self::DIRECTION_UNDEFINED;

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
        if (!in_array($directionValue, array(
            self::DIRECTION_UNDEFINED,
            self::DIRECTION_IN,
            self::DIRECTION_OUT,
            self::DIRECTION_INTERNAL
        ))) {
            throw new \Exception("Invalid directionValue value: $directionValue");
        }

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