<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class HeaderTradeDelivery
{
    /**
     * @Type("Easybill\ZUGFeRD\Model\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ShipToTradeParty")
     */
    public ?TradeParty $shipToTradeParty = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\SupplyChainEvent")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ActualDeliverySupplyChainEvent")
     */
    public ?SupplyChainEvent $chainEvent = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\ReferencedDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("DeliveryNoteReferencedDocument")
     */
    public ?ReferencedDocument $deliveryNoteReferencedDocument = null;
}
