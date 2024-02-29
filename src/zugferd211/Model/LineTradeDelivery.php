<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineTradeDelivery
{
    #[Type(\Easybill\ZUGFeRD211\Model\Quantity::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BilledQuantity')]
    public Quantity $billedQuantity;

    #[Type(\Easybill\ZUGFeRD211\Model\SupplyChainEvent::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ActualDeliverySupplyChainEvent')]
    public ?SupplyChainEvent $chainEvent = null;
}
