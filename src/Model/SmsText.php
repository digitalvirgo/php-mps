<?php

namespace DigitalVirgo\MPS\Model;

class SmsText extends SmsAbstract
{

    protected $_text;

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->_text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->_text;
    }

    public function getMessageType()
    {
        return 'SMSText';
    }

    protected function validate()
    {
        if (empty($this->_text)) {
            throw new \Exception('text field is required');
        }

        return parent::validate();
    }


    /**
     * @return \DOMElement|void
     */
    protected function _prepareXml()
    {
        $message = parent::_prepareXml();

        $text = $this->getText();
        if (!empty($text)) {
            $param = $this->_xml->createElement('text', $text);
            $message->appendChild($param);
        }
    }

}