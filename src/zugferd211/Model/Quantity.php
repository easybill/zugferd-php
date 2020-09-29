<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class Quantity
{
    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("unitCode")
     */
    private $unitCode;

    /**
     * @var string
     * @Type("string")
     * @XmlValue(cdata = false)
     */
    private $value;
}
