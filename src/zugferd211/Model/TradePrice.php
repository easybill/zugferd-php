<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;

class TradePrice
{
    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("ChargeAmount")
     */
    public Amount $chargeAmount;

    public static function create(string $amount): self
    {
        $self = new self();
        $self->chargeAmount = Amount::create($amount);
        return $self;
    }
}
