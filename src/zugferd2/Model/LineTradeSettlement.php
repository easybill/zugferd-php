<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

#[AccessorOrder(order: 'custom', custom: ['tradeTax', 'billingSpecifiedPeriod', 'specifiedTradeAllowanceCharge', 'monetarySummation', 'tradeAccountingAccount'])]
class LineTradeSettlement
{
    /**
     * @var TradeTax[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeTax>')]
    #[XmlList(entry: 'ApplicableTradeTax', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $tradeTax = [];

    /**
     * @var TradeAllowanceCharge[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeAllowanceCharge>')]
    #[XmlList(entry: 'SpecifiedTradeAllowanceCharge', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $specifiedTradeAllowanceCharge = [];

    #[Type(SpecifiedPeriod::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BillingSpecifiedPeriod')]
    public ?SpecifiedPeriod $billingSpecifiedPeriod = null;

    #[Type(TradeSettlementLineMonetarySummation::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('SpecifiedTradeSettlementLineMonetarySummation')]
    public TradeSettlementLineMonetarySummation $monetarySummation;

    /**
     * @var TradeAccountingAccount[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeAccountingAccount>')]
    #[XmlList(entry: 'ReceivableSpecifiedTradeAccountingAccount', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $tradeAccountingAccount = [];
}
