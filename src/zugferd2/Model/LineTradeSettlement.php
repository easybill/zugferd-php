<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class LineTradeSettlement
{
    /** @var TradeTax[] */
    #[Type('array<' . TradeTax::class . '>')]
    #[XmlList(entry: 'ApplicableTradeTax', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $tradeTax = [];

    #[Type(Period::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BillingSpecifiedPeriod')]
    public ?Period $billingSpecifiedPeriod = null;

    /** @var TradeAllowanceCharge[] */
    #[Type('array<' . TradeAllowanceCharge::class . '>')]
    #[XmlList(entry: 'SpecifiedTradeAllowanceCharge', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $specifiedTradeAllowanceCharge = [];

    #[Type(TradeSettlementLineMonetarySummation::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('SpecifiedTradeSettlementLineMonetarySummation')]
    public TradeSettlementLineMonetarySummation $monetarySummation;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('AdditionalReferencedDocument')]
    public ReferencedDocument $referencedDocument;

    /** @var TradeAccountingAccount[] */
    #[Type('array<' . TradeAccountingAccount::class . '>')]
    #[XmlList(entry: 'ReceivableSpecifiedTradeAccountingAccount', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $tradeAccountingAccount = [];
}
