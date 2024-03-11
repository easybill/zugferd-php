<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

#[AccessorOrder(order: 'custom', custom: ['buyerOrderReferencedDocument', 'grossPrice', 'netPrice'])]
class LineTradeAgreement
{
    #[Type(TradePrice::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('GrossPriceProductTradePrice')]
    public ?TradePrice $grossPrice = null;

    #[Type(TradePrice::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('NetPriceProductTradePrice')]
    public TradePrice $netPrice;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BuyerOrderReferencedDocument')]
    public ?ReferencedDocument $buyerOrderReferencedDocument = null;
}
