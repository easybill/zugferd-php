<?php

namespace Easybill\ZUGFeRD211\Model;

use Easybill\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeSettlementLineMonetarySummation
{
    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD211\Model\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("LineTotalAmount")
     */
    public $totalAmount;
    
}
