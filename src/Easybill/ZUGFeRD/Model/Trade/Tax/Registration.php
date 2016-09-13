<?php

namespace Easybill\ZUGFeRD\Model\Trade\Tax;

use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Class Registration
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class Registration
{

    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("schemeID")
     */
    private $schemeID = '';

    /**
     * @var string
     * @Type("string")
     * @XmlValue(cdata = false)
     */
    private $value = '';

    /**
     * TaxRegistration constructor.
     *
     * @param string $schemeID
     * @param string $value
     */
    public function __construct($schemeID = '', $value = '')
    {
        $this->schemeID = $schemeID;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getSchemeID()
    {
        return $this->schemeID;
    }

    /**
     * @param string $schemeID
     */
    public function setSchemeID($schemeID)
    {
        $this->schemeID = $schemeID;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}