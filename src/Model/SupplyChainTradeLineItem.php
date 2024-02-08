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

class SupplyChainTradeLineItem
{
    #[Type(DocumentLineDocument::class)]
    #[SerializedName('AssociatedDocumentLineDocument')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public DocumentLineDocument $associatedDocumentLineDocument;

    #[Type(TradeProduct::class)]
    #[SerializedName('SpecifiedTradeProduct')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public TradeProduct $specifiedTradeProduct;

    #[Type(LineTradeAgreement::class)]
    #[SerializedName('SpecifiedLineTradeAgreement')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public LineTradeAgreement $tradeAgreement;

    #[Type(LineTradeDelivery::class)]
    #[SerializedName('SpecifiedLineTradeDelivery')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?LineTradeDelivery $delivery = null;

    #[Type(LineTradeSettlement::class)]
    #[SerializedName('SpecifiedLineTradeSettlement')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public LineTradeSettlement $specifiedLineTradeSettlement;
}
