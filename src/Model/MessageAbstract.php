<?php

namespace DigitalVirgo\MPS\Model;

abstract class MessageAbstract extends ModelAbstract
{

    const DATE_FORMAT = 'Y-m-d\TH:i:s\Z';

    const PRIORITY_0 = 0;
    const PRIORITY_1 = 1;
    const PRIORITY_2 = 2;
    const PRIORITY_3 = 3;

    const BILL_BILL = 'BILL';
    const BILL_FREE = 'FREE';

    const CATEGORY_PAYMENT = 'PLAYMENT';
    const CATEGORY_HELP    = 'HELP';
    const CATEGORY_GAME    = 'GAME';
    const CATEGORY_INFO    = 'INFO';
    const CATEGORY_CHAT    = 'CHAT';
    const CATEGORY_MEDIA   = 'MEDIA';
    const CATEGORY_VOTE    = 'VOTE';
    const CATEGORY_CONTENT = 'CONTENT';

    const GENERIC_DELIVERY_REPORT     = 1;
    const MOBILE_USER_DELIVERY_REPORT = 3;

    /**
     * @var \DOMDocument
     */
    protected $_xml;

    /**
     * @var string
     */
    protected $_username;

    /**
     * @var string
     */
    protected $_password;

    /**
     * @var integer
     */
    protected $_deliveryRequest;

    /**
     * @var string
     */
    protected $_id;

    /**
     * @var string
     */
    protected $_sender;

    /**
     * @var string
     */
    protected $_senderAlias;

    /**
     * @var \DateTime
     */
    protected $_deliveryDate;

    /**
     * @var \DateTime
     */
    protected $_sendDate;

    /**
     * @var \DateTime
     */
    protected $_validityDate;

    /**
     * @var \DateTime
     */
    protected $_creationDate;

    /**
     * @var integer
     */
    protected $_priority;

    /**
     * @var string
     */
    protected $_category;

    /**
     * @var string
     */
    protected $_billCode;

    /**
     * @var integer
     */
    protected $_replyToID;

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param string $billCode
     */
    public function setBillCode($billCode)
    {
        if (!in_array($billCode, array(
            self::BILL_BILL,
            self::BILL_FREE
        ))) {
            throw new \Exception("Invalid billCode value: $billCode");
        }

        $this->_billCode = $billCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillCode()
    {
        return $this->_billCode;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {

        if (!in_array($category, array(
            self::CATEGORY_PAYMENT,
            self::CATEGORY_HELP,
            self::CATEGORY_GAME,
            self::CATEGORY_INFO,
            self::CATEGORY_CHAT,
            self::CATEGORY_MEDIA,
            self::CATEGORY_VOTE,
            self::CATEGORY_CONTENT
        ))) {
            throw new \Exception("Invalid category value: $category");
        }


        $this->_category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * @param \DateTime $deliveryDate
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->_deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryDate()
    {
        return $this->_deliveryDate;
        return $this;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority)
    {
        if (!in_array($priority, array(
            self::PRIORITY_0,
            self::PRIORITY_1,
            self::PRIORITY_2,
            self::PRIORITY_3
        ))) {
             throw new \Exception("Invalid priority value: $priority");
        }

        $this->_priority = $priority;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->_priority;
    }

    /**
     * @param int $replyToID
     */
    public function setReplyToID($replyToID)
    {
        $this->_replyToID = $replyToID;
        return $this;
    }


    /**
     * @return int
     */
    public function getReplyToID()
    {
        return $this->_replyToID;
    }

    /**
     * @param \DateTime $sendDate
     */
    public function setSendDate($sendDate)
    {
        $this->_sendDate = $sendDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSendDate()
    {
        return $this->_sendDate;
    }

    /**
     * @param string $sender
     */
    public function setSender($sender)
    {
        $this->_sender = $sender;
        return $this;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->_sender;
    }

    /**
     * @param string $senderAlias
     */
    public function setSenderAlias($senderAlias)
    {
        $this->_senderAlias = $senderAlias;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderAlias()
    {
        return $this->_senderAlias;
    }

    /**
     * @param \DateTime $validityDate
     */
    public function setValidityDate($validityDate)
    {
        $this->_validityDate = $validityDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidityDate()
    {
        return $this->_validityDate;
    }

    /**
     * @param int $deliveryRequest
     */
    public function setDeliveryRequest($deliveryRequest)
    {
        if (!in_array($deliveryRequest, array(
            self::GENERIC_DELIVERY_REPORT,
            self::MOBILE_USER_DELIVERY_REPORT
        ))) {
            throw new \Exception("Invalid deliveryRequest value: $deliveryRequest");
        }

        $this->_deliveryRequest = $deliveryRequest;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeliveryRequest()
    {
        return $this->_deliveryRequest;
    }



    public abstract function getMessageType();

    /**
     * @return string Message in XML format
     */
    public function toXml()
    {
        $this->_prepareXml();
        return $this->_xml->saveXML();
    }

    /**
     * @return \DOMElement
     */
    protected function _prepareXml()
    {
        $this->_xml    = new \DOMDocument();

        $root = $this->_xml->createElement('RestInvocation');

        $this->_xml->appendChild($root);

        $message = $this->_xml->createElement('message');

        $attr = $this->_xml->createAttribute('class');
        $attr->appendChild($this->_xml->createTextNode($this->getMessageType()));
        $message->appendChild($attr);

        $root->appendChild($message);


        $username = $this->getUsername();
        if (!empty($username)) {
            $username = $this->_xml->createElement('username', $username);
            $root->appendChild($username);
        }

        $password = $this->getPassword();
        if (!empty($password)) {
            $password = $this->_xml->createElement('password', $password);
            $root->appendChild($password);
        }

        $deliveryRequest = $this->getDeliveryRequest();
        if (!empty($deliveryRequest)) {
            $deliveryRequest = $this->_xml->createElement('deliveryRequest', $deliveryRequest);
            $root->appendChild($deliveryRequest);
        }


        $id = $this->getId();
        if (!empty($id)) {
            $param = $this->_xml->createElement('id', $id);
            $message->appendChild($param);
        }

        $sender = $this->getSender();
        if (!empty($sender)) {
            $param = $this->_xml->createElement('sender', $sender);
            $message->appendChild($param);
        }

        $senderAlias = $this->getSenderAlias();
        if (!empty($senderAlias)) {
            $param = $this->_xml->createElement('senderAlias', $senderAlias);
            $message->appendChild($param);
        }


        $deliveryDate = $this->getDeliveryDate();
        if (!empty($deliveryDate)) {
            $param = $this->_xml->createElement('deliveryDate',
                ($deliveryDate instanceof \DateTime)
                    ? $deliveryDate->format(self::DATE_FORMAT)
                    : $deliveryDate
            );
            $message->appendChild($param);
        }

        $sendDate = $this->getSendDate();
        if (!empty($sendDate)) {
            $param = $this->_xml->createElement('sendDate',
                ($sendDate instanceof \DateTime)
                    ? $sendDate->format(self::DATE_FORMAT)
                    : $sendDate
            );
            $message->appendChild($param);
        }


        $validityDate = $this->getValidityDate();
        if (!empty($validityDate)) {
            $param = $this->_xml->createElement('validityDate',
                ($validityDate instanceof \DateTime)
                    ? $validityDate->format(self::DATE_FORMAT)
                    : $validityDate
            );
            $message->appendChild($param);
        }

        $creationDate = $this->getCreationDate();
        if (!empty($creationDate)) {
            $param = $this->_xml->createElement('creationDate',
                ($creationDate instanceof \DateTime)
                    ? $creationDate->format(self::DATE_FORMAT)
                    : $creationDate
            );
            $message->appendChild($param);
        }

        $priority = $this->getPriority();
        if (!empty($priority)) {
            $param = $this->_xml->createElement('priority', $priority);
            $message->appendChild($param);
        }

        $category = $this->getCategory();
        if (!empty($category)) {
            $param = $this->_xml->createElement('category', $category);
            $message->appendChild($param);
        }

        $billCode = $this->getBillCode();
        if (!empty($billCode)) {
            $param = $this->_xml->createElement('billCode', $billCode);
            $message->appendChild($param);
        }

        $replyToID = $this->getReplyToID();
        if (!empty($replyToID)) {
            $param = $this->_xml->createElement('replyToID', $replyToID);
            $message->appendChild($param);
        }

        return $message;
    }

    public function validate()
    {
        if (empty($this->_sender)) {
            throw new \Exception('Sender field is required');
        }

        if (empty($this->_username)) {
            throw new \Exception('username field is required');
        }

        if (empty($this->_password)) {
            throw new \Exception('username field is required');
        }

        return true;
    }

}