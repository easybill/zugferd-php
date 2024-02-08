<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class HeaderTradeDelivery
{
    #[Type(TradeParty::class)]
    #[SerializedName('ShipToTradeParty')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?TradeParty $shipToTradeParty = null;

    #[Type(SupplyChainEvent::class)]
    #[SerializedName('ActualDeliverySupplyChainEvent')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?SupplyChainEvent $chainEvent = null;

    #[Type(ReferencedDocument::class)]
    #[SerializedName('DeliveryNoteReferencedDocument')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?ReferencedDocument $deliveryNoteReferencedDocument = null;
}
