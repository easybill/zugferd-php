<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DateTime
{
    /**
     * @var DateTimeString
     * @Type("Easybill\ZUGFeRD211\Model\DateTimeString")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100")
     * @SerializedName("DateTimeString")
     */
    public $dateTimeString;
}
