<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineTradeDelivery
{
    /**
     * @var Quantity
     * @Type("Easybill\ZUGFeRD211\Model\Quantity")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BilledQuantity")
     */
    private $billedQuantity;
}
