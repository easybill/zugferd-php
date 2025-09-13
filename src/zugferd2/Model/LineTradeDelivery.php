<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineTradeDelivery
{
    #[Type(Quantity::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BilledQuantity')]
    public Quantity $billedQuantity;

    #[Type(Quantity::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ChargeFreeQuantity')]
    public ?Quantity $chargeFreeQuantity = null;

    #[Type(Quantity::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('PackageQuantity')]
    public ?Quantity $packageQuantity = null;

    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ShipToTradeParty')]
    public ?TradeParty $shipToTradeParty = null;

    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('UltimateShipToTradeParty')]
    public ?TradeParty $ultimateShipToTradeParty = null;

    #[Type(SupplyChainEvent::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ActualDeliverySupplyChainEvent')]
    public ?SupplyChainEvent $actualDeliverySupplyChainEvent = null;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('DespatchAdviceReferencedDocument')]
    public ?ReferencedDocument $despatchAdviceReferencedDocument = null;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ReceivingAdviceReferencedDocument')]
    public ?ReferencedDocument $receivingAdviceReferencedDocument = null;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('DeliveryNoteReferencedDocument')]
    public ?ReferencedDocument $deliveryNoteReferencedDocument = null;
}
