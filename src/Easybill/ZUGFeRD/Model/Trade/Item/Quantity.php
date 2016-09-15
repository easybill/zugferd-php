<?php


namespace Easybill\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Class BilledQuantity
 *
 * @package Easybill\ZUGFeRD\Model\Trade\Item
 */
class Quantity
{

    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("unitCode")
     */
    private $unitCode = '';

    /**
     * @var double
     * @Type("double")
     * @XmlValue(cdata = false)
     */
    private $value = '';

    /**
     * Quantity constructor.
     *
     * @param string $unitCode
     * @param double $value
     */
    public function __construct($unitCode, $value)
    {
        $this->unitCode = $unitCode;
        $this->value = doubleval($value);
    }

    /**
     * @return string
     */
    public function getUnitCode()
    {
        return $this->unitCode;
    }

    /**
     * @param string $unitCode
     */
    public function setUnitCode($unitCode)
    {
        $this->unitCode = $unitCode;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param double $value
     */
    public function setValue($value)
    {
        $this->value = doubleval($value);
    }

}