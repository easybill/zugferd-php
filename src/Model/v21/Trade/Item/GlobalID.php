<?php namespace Easybill\ZUGFeRD\Model\v21\Trade\Item;

use Easybill\ZUGFeRD\Model\v21\Trade\Amount;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class GlobalID
{
    /**
     * @var string
     * @Type("string")
     * @XmlValue(cdata = false)
     * @Accessor(getter="getValue")
     */
    private $value;

    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("schemeID")
     * @Accessor(getter="getSchemeID")
     */
    private $schemeID;

    public function __construct($value, $schemeID = '0160')
    {
        $this->schemeID = $schemeID;
        $this->value = $value;
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
     * @param bool $isSum
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getSchemeID()
    {
        return $this->schemeID;
    }

    /**
     * @param string $currency
     * @return self
     */
    public function setSchemeID($schemeID)
    {
        $this->schemeID = $schemeID;
        return $this;
    }
}