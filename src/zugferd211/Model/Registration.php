<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class Registration
{
    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("schemeID")
     */
    public $schemeID;

    /**
     * @var string
     * @Type("string")
     * @XmlValue(cdata = false)
     */
    public $value;
}
