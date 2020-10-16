<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeSettlementLineMonetarySummation
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("LineTotalAmount")
     */
    public Amount $totalAmount;

    public static function create(string $totalAmount): self
    {
        $self = new self();
        $self->totalAmount = Amount::create($totalAmount);
        return $self;
    }
}
